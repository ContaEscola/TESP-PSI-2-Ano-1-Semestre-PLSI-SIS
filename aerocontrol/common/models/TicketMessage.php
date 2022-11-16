<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket_message".
 *
 * @property int $id
 * @property string $message
 * @property string|null $photo
 * @property int $sender_id
 * @property int $support_ticket_id
 *
 * @property SupportTicket $supportTicket
 */
class TicketMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ticket_message}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message', 'sender_id', 'support_ticket_id'], 'required'],
            [['sender_id', 'support_ticket_id'], 'integer'],
            [['photo', 'message'], 'trim'],
            ['message', 'string', 'max' => 255],
            ['photo', 'string', 'max' => 75],
            ['photo', 'unique'],
            ['support_ticket_id', 'exist', 'skipOnError' => true, 'targetClass' => SupportTicket::class, 'targetAttribute' => ['support_ticket_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Mensagem',
            'photo' => 'Imagem',
            'sender_id' => 'ID do Emissor',
            'support_ticket_id' => 'ID do Ticket de Suporte',
        ];
    }

    /**
     * Gets query for [[SupportTicket]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTicket()
    {
        return $this->hasOne(SupportTicket::class, ['id' => 'support_ticket_id']);
    }
}
