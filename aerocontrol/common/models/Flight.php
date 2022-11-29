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
    public $possible_flight_airports_for_dropdown;

    public $possible_flight_airplanes_for_dropdown;


    public function __construct($config = [])
    {
        // Setups the possible values for flight airport
        $this->setupPossibleFlightAirports();

        // Setups the possible values for flight airplane
        $this->setupPossibleFlightAirplanes();


        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%flight}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['terminal', 'departure_date', 'arrival_date', 'price', 'distance', 'state', 'discount_percentage', 'origin_airport_id', 'arrival_airport_id', 'airplane_id'], 'required', 'message' => "{attribute} não pode ser vazio."],
            [['estimated_departure_date', 'estimated_arrival_date', 'departure_date', 'arrival_date'], 'string', 'message' => "{attribute} tem formato inválido."],
            [['price', 'distance'], 'number','message'=>'{attribute} tem que ser um número.'],
            [['terminal', 'state'], 'trim'],

            ['state', 'in', 'range' => [
                'Previsto',
                'Chegou',
                'Partiu',
                'Cancelado',
                'Embarque',
                'Ultima Chamada'
            ], 'strict' => true],

            ['state', 'default', 'value' => 'Previsto'],

            [['discount_percentage', 'origin_airport_id', 'arrival_airport_id', 'airplane_id'], 'integer','message'=>'{attribute} tem que ser um número inteiro.'],
            ['terminal', 'string', 'max' => 30,'message'=>'{attribute} não pode exceder os 30 caracteres.'],

            ['airplane_id', 'exist', 'skipOnError' => true, 'targetClass' => Airplane::class, 'targetAttribute' => ['airplane_id' => 'id']],
            ['arrival_airport_id', 'exist', 'skipOnError' => true, 'targetClass' => Airport::class, 'targetAttribute' => ['arrival_airport_id' => 'id']],
            ['origin_airport_id', 'exist', 'skipOnError' => true, 'targetClass' => Airport::class, 'targetAttribute' => ['origin_airport_id' => 'id']],
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
            'estimated_departure_date' => 'Data de partida estimada',
            'estimated_arrival_date' => 'Data de chegada estimada',
            'departure_date' => 'Data de partida',
            'arrival_date' => 'Data de chegada',
            'price' => 'Preço',
            'distance' => 'Distância',
            'state' => 'Estado',
            'discount_percentage' => 'Desconto(%)',
            'origin_airport_id' => 'ID do Aeroporto de Origem',
            'arrival_airport_id' => 'ID do Aeroporto de Chegada',
            'airplane_id' => 'ID do Aeroporto',
        ];
    }

    /**
     * Setups the possible flight airport for this model
     *
     */
    protected function setupPossibleFlightAirports()
    {
        $this->possible_flight_airports = Airport::getPossibleAirportsIDs();
        $this->possible_flight_airports_for_dropdown = Airport::getPossibleAirportsForDropdowns();
    }

    /**
     * Setups the possible flight airplane for this model
     *
     */
    protected function setupPossibleFlightAirplanes()
    {
        $this->possible_flight_airplanes = Airplane::getPossibleAirplanesIDs();
        $this->possible_flight_airplanes_for_dropdown = Airplane::getPossibleAirplanesForDropdowns();
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
