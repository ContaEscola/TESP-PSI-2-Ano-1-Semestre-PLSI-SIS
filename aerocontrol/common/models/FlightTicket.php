<?php

namespace common\models;

use Yii;

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
        return 'flight_ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'purchase_date', 'checkin', 'client_id', 'flight_id', 'payment_method_id'], 'required'],
            [['price'], 'number'],
            [['purchase_date'], 'safe'],
            [['checkin', 'client_id', 'flight_id', 'payment_method_id'], 'integer'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'client_id']],
            [['flight_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flight::class, 'targetAttribute' => ['flight_id' => 'id']],
            [['payment_method_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::class, 'targetAttribute' => ['payment_method_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'flight_ticket_id' => 'Flight Ticket ID',
            'price' => 'Price',
            'purchase_date' => 'Purchase Date',
            'checkin' => 'Checkin',
            'client_id' => 'Client ID',
            'flight_id' => 'Flight ID',
            'payment_method_id' => 'Payment Method ID',
        ];
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
