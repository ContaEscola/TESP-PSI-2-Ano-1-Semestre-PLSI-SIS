<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class SupportTicketForm extends Model
{
    public $title;
    public $message;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'message'], 'required', 'message' => "{attribute} não pode ser vazio."],
            ['title', 'string', 'max' => 20, 'message' => '{attribute} não pode exceder os 20 caracteres.'],
            ['message', 'string', 'max' => 255, 'message' => '{attribute} não pode exceder os 255 caracteres.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Titulo:',
            'message' => 'Mensagem:',
        ];
    }

    public function create()
    {

    }
}
