<?php

namespace frontend\models;

use common\models\Client;
use Psy\VarDumper\Dumper;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $gender;
    public $country;
    public $city;
    public $birthdate;
    public $phone;
    public $phone_country_code;




    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['first_name', 'trim'],
            ['first_name', 'required'],
            ['first_name', 'string', 'min' => 2, 'max' => 255],

            ['last_name', 'trim'],
            ['last_name', 'required'],
            ['last_name', 'string', 'min' => 2, 'max' => 255],

            ['gender', 'in', 'range' => [
                'Masculino',
                'Feminino',
                'Outro'
            ], 'strict' => true],

            ['country', 'trim'],
            ['country', 'required'],
            ['country', 'string', 'min' => 2, 'max' => 255],

            ['city', 'string', 'max' => 75],

            ['birthdate','required'],
            ['birthdate', 'date','format'=>'yyyy-MM-dd'],

            ['phone', 'string', 'max' => 15],

            ['phone_country_code', 'string', 'max' => 5],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->gender = $this->gender;
        $user->country = $this->country;
        $user->city = $this->city;
        $user->birthdate = $this->birthdate;
        $user->phone = $this->phone;
        $user->phone_country_code = $this->phone_country_code;
        $user->password_reset_token = null;
        $user->status = 10;
        $user->save();

        //adicionar client
        $client=new Client();
        $client->client_id=$user->id;
        $client->save();
        $auth = Yii::$app->authManager;
        $clientRole = $auth->getRole('client');
        $auth->assign($clientRole, $user->getId());
        return $this->sendEmail($user);
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
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
