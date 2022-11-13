<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "airplane".
 *
 * @property int $id
 * @property string $name
 * @property int $capacity
 * @property int $state
 * @property int $company_id
 *
 * @property Company $company
 * @property Flight[] $flights
 */
class Airplane extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'airplane';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'capacity', 'state', 'company_id'], 'required'],
            [['capacity', 'state', 'company_id'], 'integer'],
            [['name'], 'string', 'max' => 75],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
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
            'capacity' => 'Capacity',
            'state' => 'State',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }

    /**
     * Gets query for [[Flights]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlights()
    {
        return $this->hasMany(Flight::class, ['airplane_id' => 'id']);
    }
}
