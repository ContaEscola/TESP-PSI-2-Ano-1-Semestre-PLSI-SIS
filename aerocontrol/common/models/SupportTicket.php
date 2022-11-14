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
 * @property int $employee_id
 *
 * @property Client $client
 * @property Employee $employee
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
        return 'support_ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'state', 'client_id', 'employee_id'], 'required'],
            [['state'], 'string'],
            [['state'], 'in','range'=>[
                'Por Rever',
                'Concluido',
                'Em Processo'
            ]],
            [['state'],'default','value'=>'Por Rever'],
            [['client_id', 'employee_id'], 'integer'],
            [['title'], 'string', 'max' => 20],
            [['title'], 'trim'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'client_id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['employee_id' => 'employee_id']],
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
            'client_id' => 'ID do cliente',
            'employee_id' => 'ID do funcionário',
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
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['employee_id' => 'employee_id']);
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
