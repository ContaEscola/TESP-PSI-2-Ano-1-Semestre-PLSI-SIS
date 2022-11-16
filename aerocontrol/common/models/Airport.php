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
            [['country', 'city', 'name', 'website'], 'required'],
            [['country', 'website', 'city', 'name'], 'trim'],
            [['country', 'website'], 'string', 'max' => 50],
            [['city', 'name'], 'string', 'max' => 75],
            ['name', 'unique'],
            ['website', 'unique'],
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
