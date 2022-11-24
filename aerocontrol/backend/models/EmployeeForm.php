<?php

namespace backend\models;

use common\models\Employee;
use common\models\EmployeeFunction;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

class EmployeeForm extends Model
{
    private $possible_employee_functions;
    private $possible_employee_functions_for_rule;

    // User
    public $username;
    public $email;
    public $password_hash;
    public $first_name;
    public $last_name;
    public $gender;
    public $country;
    public $city;
    public $birthdate;
    public $phone;
    public $phone_country_code;


    // Employee
    public $employee_id;
    public $tin;
    public $num_emp;
    public $ssn;
    public $street;
    public $zip_code;
    public $iban;
    public $qualifications;
    public $function_id;


    private $_user;
    private $_employee;

    public function __construct($employee_id = null, $config = [])
    {

        // Setup of possible employee functions and array to put on rule
        $this->possible_employee_functions = EmployeeFunction::find()->select(['id', 'name'])->orderBy('name')->all();
        foreach ($this->possible_employee_functions as $function)
            $this->possible_employee_functions_for_rule[] = $function->id;


        // Load values on UpdateAction
        if ($employee_id !== null) {
            $this->employee_id = $employee_id;

            $user = $this->getUser();
            $employee = $this->getEmployee();
            $this->setAttributes($user->getAttributes());
            $this->setAttributes($employee->getAttributes());
        }

        parent::__construct();
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // User   
            ['username', 'trim'],
            ['username', 'required', 'message' => "É necessário um username."],
            [
                'username', 'string',
                'min' => 2, 'tooShort' => 'A username deve conter pelo menos 2 caracteres.',
                'max' => 30, 'tooLong' => 'A username não pode exceder os 30 caracteres.'
            ],
            [
                'username', 'unique',
                'targetClass' => 'common\models\User',
                'filter' => function ($query) {
                    if ($this->employee_id !== null)
                        $query->where([
                            'and',
                            ['!=', 'id', $this->employee_id],
                            ['=', 'username', $this->username]
                        ]);
                    else
                        $query->where(['=', 'username', $this->username]);
                },
                'message' => 'Esta username já está a ser utilizada.'
            ],

            ['email', 'trim'],
            ['email', 'required', 'message' => "É necessário um email."],
            ['email', 'email', 'message' => "Email inválido."],

            ['password_hash', 'trim'],
            ['password_hash', 'required', 'message' => "É necessário uma password."],
            ['password_hash', 'string', 'min' => Yii::$app->params['user.passwordMinLength'], 'tooShort' => "A password deve conter pelo menos " . Yii::$app->params['user.passwordMinLength'] . " caracteres."],

            ['first_name', 'trim'],
            ['first_name', 'required', 'message' => "É necessário o primeiro nome."],
            [
                'first_name', 'string',
                'max' => 50, 'tooLong' => 'O primeiro nome não pode exceder os 50 caracteres.'
            ],

            ['last_name', 'trim'],
            ['last_name', 'required', 'message' => "É necessário o último nome."],
            [
                'last_name', 'string',
                'max' => 50, 'tooLong' => 'O último nome não pode exceder os 50 caracteres.'
            ],

            ['gender', 'required', 'message' => "É necessário o género."],
            ['gender', 'in', 'range' => User::POSSIBLE_GENDERS, 'strict' => true],

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

            ['birthdate', 'required', 'message' => "É necessária a data de nascimento."],
            ['birthdate', 'date', 'format' => 'yyyy-MM-dd'],

            ['phone_country_code', 'trim'],
            ['phone_country_code', 'required', 'message' => "É necessário o indicativo do nº de telemóvel."],
            ['phone_country_code', 'match', 'pattern' => '/\+[\d]{1,4}$/', 'message' => "Formato inválido.\nExemplo: +000"],

            ['phone', 'trim'],
            ['phone', 'required', 'message' => "É necessário o nº de telemóvel."],
            [
                'phone', 'number',
                'numberPattern' => '/[\d]{4,15}$/', 'message' => "O nº de telemóvel só pode conter números, ter pelo menos 4 números e não pode exceder os 15 números.",
            ],

            // Employee
            [['tin', 'num_emp', 'ssn', 'zip_code', 'street', 'iban', 'qualifications'], 'trim'],

            ['tin', 'required', 'message' => "É necessário o nº de contribuinte."],
            [
                'tin', 'string',
                'max' => 20, 'tooLong' => "O nº de contribuinte não pode exceder os 20 caracteres."
            ],
            [
                'tin', 'unique', 'targetClass' => '\common\models\Employee',
                'filter' => function ($query) {
                    if ($this->employee_id !== null)
                        $query->where([
                            'and',
                            ['!=', 'employee_id', $this->employee_id],
                            ['=', 'tin', $this->tin]
                        ]);
                    else
                        $query->where(['=', 'tin', $this->tin]);
                },
                'message' => 'Este nº de contribuinte já está a ser utilizado.'
            ],


            ['num_emp', 'required', 'message' => "É necessário o nº de empregado."],
            [
                'num_emp', 'string',
                'max' => 20, 'tooLong' => 'O nº de empregado não pode exceder os 20 caracteres.'
            ],
            [
                'num_emp', 'unique', 'targetClass' => '\common\models\Employee',
                'filter' => function ($query) {
                    if ($this->employee_id !== null)
                        $query->where([
                            'and',
                            ['!=', 'employee_id', $this->employee_id],
                            ['=', 'num_emp', $this->num_emp]
                        ]);
                    else
                        $query->where(['=', 'tin', $this->num_emp]);
                },
                'message' => 'Este nº de empregado já está a ser utilizado.'
            ],

            ['ssn', 'required', 'message' => "É necessário o nº de segurança social."],
            [
                'ssn', 'string',
                'max' => 20, 'tooLong' => "O nº de segurança social não pode exceder os 20 caracteres."
            ],
            [
                'ssn', 'unique', 'targetClass' => '\common\models\Employee',
                'filter' => function ($query) {
                    if ($this->employee_id !== null)
                        $query->where([
                            'and',
                            ['!=', 'employee_id', $this->employee_id],
                            ['=', 'ssn', $this->ssn]
                        ]);
                    else
                        $query->where(['=', 'ssn', $this->ssn]);
                }, 'message' =>  'Este nº de segurança social já está a ser utilizado.'
            ],

            ['street', 'required', 'message' => "É necessário o nome da rua."],
            [
                'street', 'string',
                'max' => 100, 'tooLong' => "O nome da rua não pode exceder os 100 caracteres."
            ],

            ['zip_code', 'required', 'message' => "É necessário o código postal."],
            [
                'zip_code', 'string',
                'max' => 20, 'tooLong' => "O código postal não pode exceder os 20 caracteres."
            ],

            ['iban', 'required', 'message' => "É necessário o iban."],
            [
                'iban', 'string',
                'min' => 25, 'tooShort' => 'O iban tem de ter 25 caracteres.',
                'max' => 25, 'tooLong' => 'O iban tem de ter 25 caracteres.'
            ],
            [
                'iban', 'unique', 'targetClass' => '\common\models\Employee',
                'filter' => function ($query) {
                    if ($this->employee_id !== null)
                        $query->where([
                            'and',
                            ['!=', 'employee_id', $this->employee_id],
                            ['=', 'iban', $this->iban]
                        ]);
                    else
                        $query->where(['=', 'iban', $this->iban]);
                }, 'message' => 'Este iban já está a ser utilizado.'
            ],

            ['qualifications', 'in', 'range' => Employee::POSSIBLE_QUALIFICATIONS, 'strict' => true, 'message' => 'Qualificação inválida.'],
            ['function_id', 'in', 'range' => $this->possible_employee_functions_for_rule, 'message' => 'Função inválida']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // User
            'username' => 'Username',
            'password_hash' => 'Password',
            'first_name' => 'Primeiro nome',
            'last_name' => 'Último nome',
            'gender' => 'Género',
            'country' => 'País',
            'city' => 'Cidade',
            'birthdate' => 'Data de Nascimento',
            'email' => 'Email',
            'phone' => 'Nº Telemóvel',
            'phone_country_code' => 'Indicativo do país',
            'status' => 'Estado',

            // Employee
            'tin' => 'Nº Contribuinte',
            'num_emp' => 'Nº Empregado',
            'ssn' => 'Nº Segurança Social',
            'street' => 'Nome da rua',
            'zip_code' => 'Código Postal',
            'iban' => 'Iban',
            'qualifications' => 'Qualificações',
            'function_id' => 'Função'
        ];
    }


    /**
     * Creates new employee
     * @return bool
     */
    public function create()
    {
        if (!$this->validate())
            return null;

        // Criar user
        $user = new User();
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->setAttributes($this->getUserDetails(), false);

        $user->save();
        $this->employee_id = $user->id;

        // Criar o employee
        $employee = new Employee();
        $employee->employee_id = $user->id;
        $employee->setAttributes($this->getEmployeeDetails(), false);

        $employee->save();

        // Assign role to new employee
        $auth = Yii::$app->authManager;
        $employeeRole = $auth->getRole('employee');
        $auth->assign($employeeRole, $user->getId());

        return true;
    }

    /**
     * Updates employee
     * @return bool
     */
    public function update()
    {
        if (!$this->validate()) {
            return null;
        }

        // Update no user
        $user = $this->getUser();
        $user->setAttributes($this->getUserDetails(), false);
        $user->setPassword($this->password_hash);

        $user->save();

        // Update no employee
        $employee = $this->getEmployee();

        $employee->setAttributes($this->getEmployeeDetails(), false);
        $employee->save();

        return true;
    }

    /**
     * Gets all the possible employee functions (associative array).
     * @return array
     */
    public function getAllPossibleFunctions()
    {
        $possibleFunctions = [];


        foreach ($this->possible_employee_functions as $possibleFunction)
            $possibleFunctions[$possibleFunction->id] = $possibleFunction->name;

        return $possibleFunctions;
    }

    /**
     * Resets choosen attributes on invalid Action
     */
    public function resetAttributesOnInvalidAction()
    {
        $this->password_hash = '';
    }

    /**
     * Gets all the user details.
     * @return array
     */
    private function getUserDetails()
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'country' => $this->country,
            'city' => $this->city,
            'birthdate' => $this->birthdate,
            'phone' => $this->phone,
            'phone_country_code' => $this->phone_country_code,
            'password_reset_token' => null,
            'status' => User::STATUS_ACTIVE
        ];
    }

    /**
     * Gets all the employee details.
     * @return array
     */
    private function getEmployeeDetails()
    {
        return [
            'tin' => $this->tin,
            'num_emp' => $this->num_emp,
            'ssn' => $this->ssn,
            'street' => $this->street,
            'zip_code' => $this->zip_code,
            'iban' => $this->iban,
            'qualifications' => $this->qualifications,
            'function_id' => $this->function_id
        ];
    }


    /**
     * Finds user by [[employee_id]]
     *
     * @param int $id ID
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findOne($this->employee_id);
        }

        return $this->_user;
    }

    /**
     * Gets employee by [[$user->id]]
     *
     * @return Employee|null
     */
    protected function getEmployee()
    {
        if ($this->_employee === null) {
            $user = $this->getUser();


            $this->_employee = Employee::findOne($user->id);
        }

        return $this->_employee;
    }
}
