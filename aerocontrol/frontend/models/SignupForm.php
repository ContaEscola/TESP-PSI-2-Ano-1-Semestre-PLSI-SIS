<?php

namespace frontend\models;

use common\models\base\UserForm;
use common\models\Client;
use Yii;
use common\models\User;
use yii\base\ErrorException;

/**
 * Signup form
 */
class SignupForm extends UserForm
{
    // Para quando tivermos os emails, muda o defaultState;
    //protected $statusOnCreate = User::STATUS_INACTIVE;



    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        $transaction = Client::getDb()->beginTransaction();
        try {
            if (!parent::create())
                return null;

            // Criar o client
            $client = new Client();
            $client->client_id = $this->user_id;
            if (!$client->save())
                throw new ErrorException();


            $auth = Yii::$app->authManager;
            $clientRole = $auth->getRole('client');
            $auth->assign($clientRole, $client->client_id);

            $transaction->commit();
        } catch (ErrorException $e) {
            $transaction->rollBack();
            return null;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }


        return true;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' support'])
            ->setTo($this->email)
            ->setSubject('Registo de conta ' . Yii::$app->name)
            ->send();
    }
}
