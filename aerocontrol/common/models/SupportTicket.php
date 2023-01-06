<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "support_ticket".
 *
 * @property int $id
 * @property string $title
 * @property string $state
 * @property int $client_id
 *
 * @property Client $client
 * @property TicketItem[] $ticketItems
 * @property TicketMessage[] $ticketMessages
 */
class SupportTicket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%support_ticket}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'state', 'client_id'], 'required'],
            [['title', 'state'], 'trim'],
            ['state', 'string'],
            [['state'], 'in', 'range' => [
                'Por Rever',
                'Em Progresso',
                'Concluido'
            ]],
            ['state', 'default', 'value' => 'Por Rever'],
            ['title', 'string', 'max' => 20],
            ['client_id', 'integer'],
            ['client_id', 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'client_id']],
       ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Título',
            'state' => 'Estado',
            'client_id' => 'ID do Cliente',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::class, ['client_id' => 'client_id']);
    }

    /**
     * Gets query for [[TicketItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicketItems()
    {
        return $this->hasMany(TicketItem::class, ['support_ticket_id' => 'id']);
    }

    /**
     * Gets query for [[TicketMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicketMessages()
    {
        return $this->hasMany(TicketMessage::class, ['support_ticket_id' => 'id']);
    }
}
