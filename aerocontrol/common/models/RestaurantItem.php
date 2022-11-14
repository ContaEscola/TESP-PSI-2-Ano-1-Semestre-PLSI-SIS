<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "restaurant_item".
 *
 * @property int $id
 * @property string $item
 * @property string $image
 * @property int $state
 * @property int $restaurant_id
 *
 * @property Restaurant $restaurant
 */
class RestaurantItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurant_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item', 'image', 'state', 'restaurant_id'], 'required'],
            [['restaurant_id'], 'integer'],
            [['state'], 'boolean'],
            [['item'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 50],
            [['image','item'], 'trim'],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::class, 'targetAttribute' => ['restaurant_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item' => 'Item',
            'image' => 'Imagem',
            'state' => 'Estado',
            'restaurant_id' => 'ID do Restaurante',
        ];
    }

    /**
     * Gets query for [[Restaurant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'restaurant_id']);
    }
}
