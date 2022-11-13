<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "restaurant".
 *
 * @property int $id
 * @property string|null $name
 * @property string $description
 * @property string $phone
 * @property string|null $open_time
 * @property string|null $close_time
 * @property string|null $logo
 * @property string|null $website
 *
 * @property Manager[] $managers
 * @property RestaurantItem[] $restaurantItems
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
            [['description', 'phone'], 'required'],
            [['open_time', 'close_time'], 'safe'],
            [['name'], 'string', 'max' => 75],
            [['description'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['logo', 'website'], 'string', 'max' => 50],
            [['name'], 'unique'],
            [['logo'], 'unique'],
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
            'description' => 'Description',
            'phone' => 'Phone',
            'open_time' => 'Open Time',
            'close_time' => 'Close Time',
            'logo' => 'Logo',
            'website' => 'Website',
        ];
    }

    /**
     * Gets query for [[Managers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManagers()
    {
        return $this->hasMany(Manager::class, ['restaurant_id' => 'id']);
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
}
