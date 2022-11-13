<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lost_item".
 *
 * @property int $id
 * @property string $description
 * @property string $state
 * @property string $image
 *
 * @property TicketItem $ticketItem
 */
class LostItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lost_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'state', 'image'], 'required'],
            [['state'], 'string'],
            [['description'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 75],
            [['image'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'state' => 'State',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[TicketItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicketItem()
    {
        return $this->hasOne(TicketItem::class, ['lost_item_id' => 'id']);
    }
}
