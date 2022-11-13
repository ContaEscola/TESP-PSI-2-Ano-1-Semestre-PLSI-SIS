<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "flight".
 *
 * @property int $id
 * @property string $terminal
 * @property string $estimated_departure_date
 * @property string $estimated_arrival_date
 * @property string|null $departure_date
 * @property string|null $arrival_date
 * @property float $price
 * @property float $distance
 * @property string $state
 * @property int $discount_percentage
 * @property int $origin_airport_id
 * @property int $arrival_airport_id
 * @property int $airplane_id
 *
 * @property Airplane $airplane
 * @property Airport $arrivalAirport
 * @property FlightTicket[] $flightTickets
 * @property Airport $originAirport
 */
class Flight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'flight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['terminal', 'estimated_departure_date', 'estimated_arrival_date', 'price', 'distance', 'state', 'discount_percentage', 'origin_airport_id', 'arrival_airport_id', 'airplane_id'], 'required'],
            [['estimated_departure_date', 'estimated_arrival_date', 'departure_date', 'arrival_date'], 'safe'],
            [['price', 'distance'], 'number'],
            [['state'], 'string'],
            [['discount_percentage', 'origin_airport_id', 'arrival_airport_id', 'airplane_id'], 'integer'],
            [['terminal'], 'string', 'max' => 30],
            [['airplane_id'], 'exist', 'skipOnError' => true, 'targetClass' => Airplane::class, 'targetAttribute' => ['airplane_id' => 'id']],
            [['arrival_airport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Airport::class, 'targetAttribute' => ['arrival_airport_id' => 'id']],
            [['origin_airport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Airport::class, 'targetAttribute' => ['origin_airport_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'terminal' => 'Terminal',
            'estimated_departure_date' => 'Estimated Departure Date',
            'estimated_arrival_date' => 'Estimated Arrival Date',
            'departure_date' => 'Departure Date',
            'arrival_date' => 'Arrival Date',
            'price' => 'Price',
            'distance' => 'Distance',
            'state' => 'State',
            'discount_percentage' => 'Discount Percentage',
            'origin_airport_id' => 'Origin Airport ID',
            'arrival_airport_id' => 'Arrival Airport ID',
            'airplane_id' => 'Airplane ID',
        ];
    }

    /**
     * Gets query for [[Airplane]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAirplane()
    {
        return $this->hasOne(Airplane::class, ['id' => 'airplane_id']);
    }

    /**
     * Gets query for [[ArrivalAirport]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArrivalAirport()
    {
        return $this->hasOne(Airport::class, ['id' => 'arrival_airport_id']);
    }

    /**
     * Gets query for [[FlightTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlightTickets()
    {
        return $this->hasMany(FlightTicket::class, ['flight_id' => 'id']);
    }

    /**
     * Gets query for [[OriginAirport]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOriginAirport()
    {
        return $this->hasOne(Airport::class, ['id' => 'origin_airport_id']);
    }
}
