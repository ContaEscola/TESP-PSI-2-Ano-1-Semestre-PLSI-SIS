<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

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
        return '{{%restaurant}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'phone'], 'required'],
            [['open_time', 'close_time'], 'datetime'],
            [['name', 'description', 'phone', 'logo', 'website'], 'trim'],
            ['name', 'string', 'max' => 75],
            ['description', 'string', 'max' => 255],
            ['phone', 'string', 'max' => 20],
            [['logo', 'website'], 'string', 'max' => 50],
            ['name', 'unique'],
            ['logo', 'unique'],
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
            'phone' => 'Nº Telemóvel',
            'open_time' => 'Horário de abertura',
            'close_time' => 'Horário de fecho',
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

    /**
     * Get all the restaurants for dropdowns
     * @return array
     */
    public static function getPossibleRestaurantsForDropdowns()
    {
        $possibleRestaurants = self::find()->select(['id', 'name'])->all();

        // Maps the array containing the Restaurants to an associative array of 'id' => 'name'
        return ArrayHelper::map($possibleRestaurants, 'id', 'name');
    }
}
