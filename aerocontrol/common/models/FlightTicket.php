<?php

namespace common\models;

use Yii;
use yii\base\ErrorException;
use yii\web\ForbiddenHttpException;

/**
 * This is the model class for table "flight_ticket".
 *
 * @property int $flight_ticket_id
 * @property float $price
 * @property string $purchase_date
 * @property int $checkin
 * @property int $client_id
 * @property int $flight_id
 * @property int $payment_method_id
 *
 * @property Client $client
 * @property Flight $flight
 * @property Passenger[] $passengers
 * @property PaymentMethod $paymentMethod
 */
class FlightTicket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%flight_ticket}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'purchase_date', 'checkin', 'client_id', 'flight_id', 'payment_method_id'], 'required'],
            ['price', 'number'],
            ['purchase_date', 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['client_id', 'flight_id', 'payment_method_id'], 'integer'],
            ['checkin', 'boolean'],
            ['client_id', 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'client_id']],
            ['flight_id', 'exist', 'skipOnError' => true, 'targetClass' => Flight::class, 'targetAttribute' => ['flight_id' => 'id']],
            ['payment_method_id', 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::class, 'targetAttribute' => ['payment_method_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'flight_ticket_id' => 'ID do Bilhete de Voo',
            'price' => 'Preço',
            'purchase_date' => 'Data de compra',
            'checkin' => 'Checkin',
            'client_id' => 'ID do Cliente',
            'flight_id' => 'ID do Voo',
            'payment_method_id' => 'ID do Método de Pagamento',
        ];
    }

    /**
     * Verifica se é permitido apagar o ticket
     * @throws ForbiddenHttpException
     */
    public function deleteTicketIsPossible()
    {
        if ($this->checkin == true) throw new ForbiddenHttpException("Impossível cancelar o bilhete se o checkin já tiver sido efetuado.");
        $flightTicketTime = strtotime($this->flight->estimated_departure_date);
        $day = 60 * 60 * 24;
        $cancelTicketTime =  $flightTicketTime - ($day * 7);    // data sete dias antes do Voo

        $now = strtotime( date("d-m-Y H:i"));

        // Compara se a data  de possível cancelamento é superior à atual
        if($cancelTicketTime >= $now){
            return true;
        } else throw new ForbiddenHttpException("Impossível cancelar o bilhete sete dias antes do voo, por favor contacte o suporte.");
    }

    /**
     * Apaga os passageiros do Ticket e o Ticket
     */
    public function deleteTicket (){
        $transaction = FlightTicket::getDb()->beginTransaction();
        try {
            foreach ($this->passengers as $passenger){
                $passenger->delete();
            }
            $this->delete();

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

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::class, ['client_id' => 'client_id']);
    }

    /**
     * Gets query for [[Flight]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlight()
    {
        return $this->hasOne(Flight::class, ['id' => 'flight_id']);
    }

    /**
     * Gets query for [[Passengers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPassengers()
    {
        return $this->hasMany(Passenger::class, ['flight_ticket_id' => 'flight_ticket_id']);
    }

    /**
     * Gets query for [[PaymentMethod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::class, ['id' => 'payment_method_id']);
    }
}
