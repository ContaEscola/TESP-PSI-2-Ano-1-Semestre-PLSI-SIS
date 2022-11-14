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
        return '{{%airplane}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'capacity', 'state', 'company_id'], 'required'],
            [['capacity', 'company_id'], 'integer'],
            ['state', 'boolean'],
            ['name', 'trim'],
            ['name', 'string', 'max' => 75],
            ['company_id', 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'capacity' => 'Capacidade',
            'state' => 'Estado',
            'company_id' => 'ID da Companhia',
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