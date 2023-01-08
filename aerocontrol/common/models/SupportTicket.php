<?php

namespace common\models;
use common\models\phpMQTT;
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

    const STATE_TO_REVIEW = "Por Rever";
    const STATE_DONE = "Concluido";
    const STATE_IN_PROGRESS = "Em Progresso";

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
            ['state', 'default', 'value' => self::STATE_TO_REVIEW],
            [['title', 'state', 'client_id'], 'required'],
            [['title', 'state'], 'trim'],
            ['state', 'string'],
            [['state'], 'in', 'range' => [
                self::STATE_TO_REVIEW,
                self::STATE_IN_PROGRESS,
                self::STATE_DONE
            ]],
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

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert){
            $this->FazPublishNoMosquitto("tickets",'Novo ticket criado subscreva com "ticket-' . $this->id . '"');
        }

    }

    public function FazPublishNoMosquitto($canal,$msg)
    {
        $server = "localhost";
        $port = 1883;
        $username = ""; // set your username
        $password = ""; // set your password
        $client_id = "phpMQTT-publisher"; // unique!
        $mqtt = new phpMQTT($server, $port, $client_id);
        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        }
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
