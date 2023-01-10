<?php

namespace frontend\models;

use common\models\Flight;
use common\models\FlightTicket;
use common\models\Passenger;
use common\models\PaymentMethod;
use common\models\User;
use Exception;
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

    public const ROW_MAX_SEATS = 6;

    const LETTERS = [
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'I',
        'J',
        'K',
        'L',
        'M',
        'N',
        'O',
        'P',
        'Q',
        'R',
        'S',
        'T',
        'U',
        'V',
        'W',
        'X',
        'Y',
        'Z',
    ];

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

    public $seats_available = array();

    public $flightTicketGo;
    public $flightTicketBack;

    public $read_terms;
    public $payment_method;
    public $name = array();
    public $gender = array();
    public $extra_baggage = array();


    public function rules()
    {
        return [
            ['read_terms', 'required', 'message' => "Para prosseguir tem de aceitar os termos e condições."],

            [
                'name', 'each', 'rule' => [
                    'required', 'message' => "O nome não pode ser vazio."
                ]
            ],
            [
                'name', 'each', 'rule' => [
                    'string',
                    'max' => 50, 'tooLong' => 'O nome não pode exceder os 50 caracteres, escreva apenas o primeiro e o último.'
                ],
            ],
            [
                'gender', 'each', 'rule' => [
                    'required', 'message' => "O género não pode ser vazio."
                ]
            ],
            [
                'gender', 'each', 'rule' => [
                    'in', 'range' => self::POSSIBLE_GENDERS,
                ],
            ],

            ['extra_baggage', 'each', 'rule' => ['boolean']],
            ['payment_method', 'safe'],
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
            $this->setSeats($flightGo);
            $flightTicketGo = $this->getNewFlightTicket($flightGo);
            $flightGo->passengers_left -= $numPassengers;           // Altera os passageiros restantes que podem comprar bilhete no voo

            if (!$flightTicketGo->save() || !$flightGo->save())
                throw new ErrorException();
            else {
                $this->flightTicketGo = $flightTicketGo;
                for ($i= 0; $i < $numPassengers; $i++){     // Adiciona os passageiros à tabela passengers
                    $passenger = $this->getNewPassenger($i,$flightTicketGo->flight_ticket_id);
                    if ($passenger === null || !$passenger->save())
                        throw new ErrorException();
                }
            }

            if ($flightBack != null) { // Verifica se o cliente também comprou um bilhete de volta
                $this->setSeats($flightBack);
                $flightTicketBack = $this->getNewFlightTicket($flightBack);
                $flightBack->passengers_left -= $numPassengers;   // Altera os passageiros restantes que podem comprar bilhete no voo

                if (!$flightTicketBack->save() || !$flightBack->save())
                    throw new ErrorException();
                else {
                    $this->flightTicketBack = $flightTicketBack;
                    for ($i= 0; $i < $numPassengers; $i++){     // Adiciona os passageiros à tabela passengers
                        $passenger = $this->getNewPassenger($i,$flightTicketBack->flight_ticket_id);
                        if ($passenger === null || !$passenger->save())
                            throw new ErrorException();
                    }
                }
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
        switch ($this->payment_method) {
            case self::CREDIT_CARD:
                return PaymentMethod::findOne(1);
            case self::DEBIT_CARD:
                return PaymentMethod::findOne(2);
            case self::MBWAY:
                return PaymentMethod::findOne(3);
            case self::MULTIBANCO:
                return PaymentMethod::findOne(4);
            case self::PAYPAL:
                return PaymentMethod::findOne(5);
        }
        return null;
    }

    private function getNewFlightTicket(Flight $flight): ?FlightTicket
    {
        $flightTicket = new FlightTicket();
        $flightTicket->price = $flight->price - ($flight->discount_percentage / 100 * $flight->price);
        $flightTicket->purchase_date = date('Y-m-d H:i:s');
        $flightTicket->checkin = false;
        $flightTicket->client_id = Yii::$app->user->id;
        $flightTicket->flight_id = $flight->id;
        $flightTicket->payment_method_id = $this->getPaymentMethod()->id;
        return $flightTicket;
    }

    private function getNewPassenger(int $i, int $flightTicket_id): ?Passenger
    {
        $passenger = new Passenger();
        $passenger->name = $this->name[$i];
        $passenger->gender = $this->gender[$i];
        $seat = $this->getRandomSeat($flightTicket_id);
        if ($seat == null) return null;
        $passenger->seat = $seat;
        $passenger->extra_baggage = $this->extra_baggage[$i];
        $passenger->flight_ticket_id = $flightTicket_id;
        return clone($passenger);
    }

    public function setSeats(Flight $flight){
        // intdiv = Divisao Inteira  // resultado = nºfilas do avião totalmente preenchidas(LETRAS)
        $this->seats_available = null;
        $numberOfRows = intdiv($flight->airplane->capacity, self::ROW_MAX_SEATS);

        // $lastSeats = Resto da divisão  // Lugares extra (Não ocupa Row inteira)
        $lastSeats = (float)($flight->airplane->capacity / self::ROW_MAX_SEATS);
        $lastSeats = ($lastSeats - (int)$lastSeats)*self::ROW_MAX_SEATS;

        $j = 0;
        $letra = $this->getLetter($j);
        for ($i= 0; $i < $numberOfRows; $i++) {     // Cria as filas de lugares
            for ($k = 0;$k < self::ROW_MAX_SEATS;$k++){
                $this->seats_available[] = $letra . ($k+1);
            }

            $j++;
            $letra = $this->getLetter($j);
        }

        for ($i = 0; $i < $lastSeats;$i++)      //  Cria os ultimos lugares (os que não são uma fila completa)
            $this->seats_available[] = $letra . ($i+1);
    }

    private function getLetter($j)       //  Algoritmo  para gerar seat (A1,A2...A6,AA1...AB1...AC1, etc) de acordo com a capacidade do avião
    {
        $remainder = (float)($j / 26);
        $remainder = ($remainder - (int)$remainder) * 26;   // Primeira Letra do Seat
        $intDivision = intdiv($j, 26);                // Segunda Letra do Seat

        $letter = "";
        if($intDivision != 0) $letter.= self::LETTERS[$intDivision-1];
        $letter.= self::LETTERS[$remainder];
        return $letter;
    }

    private function getRandomSeat($flight_ticket_id){
        $canLeave = false;
        $seat = null;
        while (!$canLeave){
            try {
                $randomNumber = random_int(0, sizeof($this->seats_available)) - 1;
                $seat = $this->seats_available[$randomNumber];
                $passenger = Passenger::findOne(['flight_ticket_id' => $flight_ticket_id, 'seat' => $seat]);
                if (!$passenger) {
                    $canLeave  = true;
                } else array_splice($this->seats_available,$randomNumber,1);    //Remove seat já utilizado do array

                if (sizeof($this->seats_available) == 0) return null;
            } catch (Exception $e) {
                return null;
            }
        }
        return $seat;
    }

    public function sendEmail(User $user, bool $flightGo = null)
    {
        return Yii::$app->mailer->compose(
            ['html' => 'ticketBought-html', 'text' => 'ticketBought-text'],
            ['user' => $user, 'flightTicket' => $flightGo ? $this->flightTicketGo : $this->flightTicketBack],
        )
            ->setTo($user->email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setSubject('Aerocontrol - '. ($flightGo ?
                    $this->flightTicketGo->flight->originAirport->city . " - "  . $this->flightTicketGo->flight->arrivalAirport->city :
                    $this->flightTicketBack->flight->originAirport->city . " - "  . $this->flightTicketBack->flight->arrivalAirport->city))
            ->send();
    }
}
