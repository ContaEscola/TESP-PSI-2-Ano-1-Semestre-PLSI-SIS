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
            ['username', 'required', 'message' => "É necessário um username."],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Esta username já está a ser utilizada.'],
            [
                'username', 'string',
                'min' => 2, 'tooShort' => 'A username deve conter pelo menos 2 caracteres.',
                'max' => 30, 'tooLong' => 'A username não pode exceder os 30 caracteres.'
            ],

            ['email', 'trim'],
            ['email', 'required', 'message' => "É necessário o seu email."],
            ['email', 'email', 'message' => "Email inválido."],

            ['password', 'trim'],
            ['password', 'required', 'message' => "É necessário uma password."],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength'], 'tooShort' => "A password deve conter pelo menos " . Yii::$app->params['user.passwordMinLength'] . " caracteres."],

            ['first_name', 'trim'],
            ['first_name', 'required', 'message' => "É necessário o seu primeiro nome."],
            [
                'first_name', 'string',
                'max' => 50, 'tooLong' => 'O seu primeiro nome não pode exceder os 50 caracteres.'
            ],

            ['last_name', 'trim'],
            ['last_name', 'required', 'message' => "É necessário o seu último nome."],
            [
                'last_name', 'string',
                'max' => 50, 'tooLong' => 'O seu último nome não pode exceder os 50 caracteres.'
            ],

            ['gender', 'required', 'message' => "É necessário o seu género."],
            ['gender', 'in', 'range' => [
                'Masculino',
                'Feminino',
                'Outro'
            ], 'strict' => true],

            ['country', 'trim'],
            ['country', 'required', 'message' => "É necessário o país."],
            [
                'country', 'string',
                'min' => 4, 'tooShort' => 'O nome do país deve conter pelo menos 4 caracteres.',
                'max' => 50, 'tooLong' => 'O nome do país não pode exceder os 50 caracteres.'
            ],

            ['city', 'trim'],
            ['city', 'required', 'message' => "É necessário a cidade."],
            [
                'city', 'string',
                'min' => 1, 'tooShort' => 'O nome da cidade deve conter pelo menos 1 caractere.',
                'max' => 75, 'tooLong' => 'O nome da cidade não pode exceder os 75 caracteres.'
            ],

            ['birthdate', 'required', 'message' => "É necessário a sua data de nascimento."],
            ['birthdate', 'date', 'format' => 'yyyy-MM-dd'],

            ['phone_country_code', 'trim'],
            ['phone_country_code', 'required', 'message' => "É necessário o indicativo do seu nº de telemóvel."],
            ['phone_country_code', 'match', 'pattern' => '/\+[\d]{1,4}$/', 'message' => "Formato inválido.\nExemplo: +000"],

            ['phone', 'trim'],
            ['phone', 'required', 'message' => "É necessário o seu nº de telemóvel."],
            [
                'phone', 'number',
                'numberPattern' => '/[\d]{4,15}$/', 'message' => "O nº de telemóvel só pode conter números, ter pelo menos 4 números e não pode exceder os 15 números.",
            ],
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
        $client = new Client();
        $client->client_id = $user->id;
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
