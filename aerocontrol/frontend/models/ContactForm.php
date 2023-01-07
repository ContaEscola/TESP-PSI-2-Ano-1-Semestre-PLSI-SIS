<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $email;
    public $name;
    public $body;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['email', 'body', 'name'], 'trim'],
            [['email', 'body', 'name'], 'required', 'message' => 'O {attribute} não pode ser vazio.'],
            ['name', 'string'],
            // email has to be a valid email address
            ['email', 'email', 'message' => 'O email tem de ser válido.'],
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose(['html' => 'contact-html', 'text' => 'contact-text'],
            ['form' => $this])
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject('Aerocontrol - Suporte')
            ->setTextBody('Email enviado por: ' . $this->name . ' \n ' . $this->body)
            ->send();
    }
}
