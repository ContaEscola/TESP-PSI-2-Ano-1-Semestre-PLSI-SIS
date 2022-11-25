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
            [['country', 'website', 'city', 'name'], 'trim'],
            [['country', 'city', 'name', 'website'], 'required', 'message' => "{attribute} não pode ser vazio."],

            ['country', 'trim'],
            ['country', 'required', 'message' => "É necessário o país."],
            [
                'country', 'string',
                'min' => 4, 'tooShort' => 'O nome do país deve conter pelo menos 4 caracteres.',
                'max' => 50, 'tooLong' => 'O nome do país não pode exceder os 50 caracteres.'
            ],

            ['city', 'trim'],
            ['city', 'required', 'message' => "É necessário a cidade."],
            [
                'city', 'string',
                'min' => 1, 'tooShort' => 'O nome da cidade deve conter pelo menos 1 caractere.',
                'max' => 75, 'tooLong' => 'O nome da cidade não pode exceder os 75 caracteres.'
            ],

            [['website'], 'string', 'max' => 50, 'message' => '{attribute} não pode ser superior a 50 caracteres.'],
            [['name'], 'string', 'max' => 75, 'message' => '{attribute} não pode ser superior a 75 caracteres.'],
            ['name', 'unique', 'targetClass' => '\common\models\Airport', 'message' => 'Já existe um aeroporto com esse nome.'],
            ['website', 'unique', 'targetClass' => '\common\models\Airport', 'message' => 'Já existe um aeroporto com esse website.'],
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
