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
            [['state'],'in','range'=>[
                'Entregue',
                'Por entregar',
                'Perdido'
            ]],
            [['state'],'default','value'=>'Por entregar'],
            [['description'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 75],
            [['description','state','image'], 'trim'],
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
            'description' => 'Descrição',
            'state' => 'Estado',
            'image' => 'Imagem',
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
