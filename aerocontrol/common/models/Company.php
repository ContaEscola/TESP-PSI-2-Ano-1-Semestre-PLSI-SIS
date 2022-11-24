<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name
 * @property int $state
 *
 * @property Airplane[] $airplanes
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required', 'message' => '{attribute} não pode ser vazio.'],
            ['name', 'trim'],
            ['name', 'string', 'max' => 50, 'message' => '{attribute} não pode exceder os 50 caracteres.'],
            ['name', 'unique', 'targetClass' => '\common\models\Company', 'message' => 'Este nome já está a ser utilizado.'],
            ['state', 'boolean', 'message' => 'Selecione um dos estados.'],
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
            'state' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Airplanes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAirplanes()
    {
        return $this->hasMany(Airplane::class, ['company_id' => 'id']);
    }
}
