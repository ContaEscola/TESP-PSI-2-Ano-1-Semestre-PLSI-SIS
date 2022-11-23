<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "airport".
 *
 * @property int $id
 * @property string $country
 * @property string $city
 * @property string $name
 * @property string $website
 *
 * @property Flight[] $flights
 * @property Flight[] $flights0
 */
class Airport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%airport}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country', 'city', 'name', 'website'], 'required', 'message' => "{attribute} não pode ser vazio."],
            [['country', 'website', 'city', 'name'], 'trim'],
            [['country', 'website'], 'string', 'max' => 50,'message' => '{attribute} não pode ser superior a 50 caracteres.'],
            [['city', 'name'], 'string', 'max' => 75,'message' => '{attribute} não pode ser superior a 75 caracteres.'],
            ['name', 'unique','targetClass' => '\common\models\Airport','message' => 'Já existe um aeroporto com esse nome.'],
            ['website', 'unique','targetClass' => '\common\models\Airport','message'=> 'Já existe um aeroporto com esse website.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'País',
            'city' => 'Cidade',
            'name' => 'Nome',
            'website' => 'Website',
        ];
    }
}
