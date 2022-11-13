<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "passenger".
 *
 * @property int $id
 * @property string $name
 * @property string $gender
 * @property int $flight_ticket_id
 *
 * @property FlightTicket $flightTicket
 */
class Passenger extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'passenger';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'gender', 'flight_ticket_id'], 'required'],
            [['gender'], 'string'],
            [['flight_ticket_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['flight_ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => FlightTicket::class, 'targetAttribute' => ['flight_ticket_id' => 'flight_ticket_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'gender' => 'Gender',
            'flight_ticket_id' => 'Flight Ticket ID',
        ];
    }

    /**
     * Gets query for [[FlightTicket]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlightTicket()
    {
        return $this->hasOne(FlightTicket::class, ['flight_ticket_id' => 'flight_ticket_id']);
    }
}
