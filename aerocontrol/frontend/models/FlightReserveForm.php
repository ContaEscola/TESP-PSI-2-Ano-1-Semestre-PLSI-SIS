<?php

namespace frontend\models;

use common\models\Flight;
use common\models\FlightTicket;
use common\models\PaymentMethod;
use Yii;
use yii\base\ErrorException;
use yii\base\Model;

class FlightReserveForm extends Model
{
    public const CREDIT_CARD = "credit_card";
    public const DEBIT_CARD = "debit_card";
    public const MBWAY = "mbway";
    public const MULTIBANCO = "multibanco";
    public const PAYPAL = "paypal";

    const POSSIBLE_GENDERS = [
        'Masculino',
        'Feminino',
        'Outro'
    ];

    const POSSIBLE_GENDERS_FOR_DROPDOWN = [
        'Masculino' => 'Masculino',
        'Feminino' => 'Feminino',
        'Outro' => 'Outro'
    ];

    public $read_terms;
    public $payment_method;
    public $name = array();
    public $gender = array();
    public $extra_baggage = array();


    public function rules()
    {
        return [
            ['read_terms', 'required', 'message' => "Para prosseguir tem de aceitar os termos e condições."],
            ['name','each', 'rule' => [ 'required', 'message' => "O nome não pode ser vazio."]],
            ['payment_method', 'safe'],
            [
                'gender', 'in', 'range' => self::POSSIBLE_GENDERS,
                'strict' => true
            ],
            [
                'name','each', 'rule' => [ 'string',
                'max' => 50, 'tooLong' => 'O nome não pode exceder os 50 caracteres, escreva apenas o primeiro e o último.'],
            ],
            ['extra_baggage','each', 'rule' => [ 'boolean']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'read_terms' => 'Li e aceito integralmente os termos e condições.',
            'payment_methods' => 'Métodos de pagamento',
            'name' => 'Nome',
            'gender' => 'Género',
            'extra_baggage' => 'Bagagem Extra'
        ];
    }

    public function loadDefaultValues()
    {
        $creditCard = PaymentMethod::find()->where(['name' => 'Cartão de crédito'])->one();
        if ($creditCard && $creditCard->state)
            $this->payment_method = self::CREDIT_CARD;
        else {
            $debitCard = PaymentMethod::find()->where(['name' => 'Cartão de débito'])->one();
            if ($debitCard && $debitCard->state)
                $this->payment_method = self::DEBIT_CARD;
            else {
                $mbway = PaymentMethod::find()->where(['name' => 'MBWay'])->one();
                if ($mbway && $mbway->state)
                    $this->payment_method = self::MBWAY;
                else {
                    $multibanco = PaymentMethod::find()->where(['name' => 'Multibanco'])->one();
                    if ($multibanco && $multibanco->state)
                        $this->payment_method = self::MULTIBANCO;
                    else {
                        $paypal = PaymentMethod::find()->where(['name' => 'Paypal'])->one();
                        if ($paypal && $paypal->state)
                            $this->payment_method = self::PAYPAL;
                        else $this->payment_method = null;
                    }
                }
            }
        }
    }

    public function create(int $numPassengers, Flight $flightGo, Flight $flightBack = null)
    {
        $transaction = FlightTicket::getDb()->beginTransaction();
        try {

            $flightTicketGo = $this->getFlightTicket($flightGo);
            $flightTicketGo->flight->passengers_left -= $numPassengers;
            if (!$flightTicketGo->save() || !$flightTicketGo->flight->save())
                throw new ErrorException();

            if ($flightBack != null){ // Verifica se o cliente também comprou um bilhete de volta
                $flightBack = $this->getFlightTicket($flightBack);
                $flightBack->flight->passengers_left -= $numPassengers;
                if (!$flightBack->save() || !$flightBack->flight->save())
                    throw new ErrorException();
            }
            $transaction->commit();
        } catch (ErrorException $e) {
            $transaction->rollBack();
            return null;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        return true;
    }

    private function getPaymentMethod(): ?PaymentMethod
    {
        switch ($this->payment_method){
            case self::CREDIT_CARD:
                return PaymentMethod::findOne(1);
                break;
            case self::DEBIT_CARD:
                return PaymentMethod::findOne(2);
                break;
            case self::MBWAY:
                return PaymentMethod::findOne(3);
                break;
            case self::MULTIBANCO:
                return PaymentMethod::findOne(4);
                break;
            case self::PAYPAL:
                return PaymentMethod::findOne(5);
                break;
        }
        return null;
    }

    private function getFlightTicket(Flight $flight): ?FlightTicket
    {
        $flightTicket = new FlightTicket();
        $flightTicket->price = $flight->price - ($flight->discount_percentage / 100 * $flight->price);
        $flightTicket->purchase_date = date('Y-m-d h:i:s');
        $flightTicket->checkin = false;
        $flightTicket->client_id = Yii::$app->user->id;
        $flightTicket->flight_id = $flight->id;
        $flightTicket->payment_method_id = $this->getPaymentMethod()->id;
        return $flightTicket;
    }

}