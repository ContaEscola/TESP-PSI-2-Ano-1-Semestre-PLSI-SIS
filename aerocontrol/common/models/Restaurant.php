<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "restaurant".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $phone
 * @property string|null $open_time
 * @property string|null $close_time
 * @property string|null $logo
 * @property string|null $website
 * @property int $manager_id
 *
 * @property Restaurant $manager
 * @property RestaurantItem[] $restaurantItems
 * @property Restaurant[] $restaurants
 */
class Restaurant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'phone', 'manager_id'], 'required'],
            [['manager_id'], 'integer'],
            [['open_time', 'close_time'], 'datetime'],
            [['name', 'description', 'phone', 'logo', 'website'], 'trim'],
            [['name'], 'string', 'max' => 75],
            [['description'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['logo', 'website'], 'string', 'max' => 50],
            [['name'], 'unique'],
            [['logo'], 'unique'],
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::class, 'targetAttribute' => ['manager_id' => 'id']],
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
            'description' => 'Descrição',
            'phone' => 'Telemóvel',
            'open_time' => 'Hora de Abertura',
            'close_time' => 'Hora de Fecho',
            'logo' => 'Logo',
            'website' => 'Website',
            'manager_id' => 'ID do Manager',
        ];
    }

    /**
     * Gets query for [[Manager]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'manager_id']);
    }

    /**
     * Gets query for [[RestaurantItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurantItems()
    {
        return $this->hasMany(RestaurantItem::class, ['restaurant_id' => 'id']);
    }

    /**
     * Gets query for [[Restaurants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurants()
    {
        return $this->hasMany(Restaurant::class, ['manager_id' => 'id']);
    }
}
