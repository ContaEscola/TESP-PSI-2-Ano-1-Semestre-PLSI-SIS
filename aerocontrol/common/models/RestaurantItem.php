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
            [['state', 'restaurant_id'], 'integer'],
            [['item'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 50],
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
            'image' => 'Image',
            'state' => 'State',
            'restaurant_id' => 'Restaurant ID',
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
