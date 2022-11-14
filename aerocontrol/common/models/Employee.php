<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $employee_id
 * @property string $tin
 * @property string $num_emp
 * @property string $ssn
 * @property string $street
 * @property string $zip_code
 * @property string $iban
 * @property string $qualifications
 * @property int $function_id
 *
 * @property User $employee
 * @property EmployeeFunction $function
 * @property SupportTicket[] $supportTickets
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'tin', 'num_emp', 'ssn', 'street', 'zip_code', 'iban', 'qualifications', 'function_id'], 'required'],
            [['employee_id', 'function_id'], 'integer'],
            [['qualifications'], 'string'],
            [['qualifications'], 'in','range'=> [
                'Até ao 9º ano de escolaridade',
                'Secundário',
                'Curso técnico superior profissional',
                'Diploma de Especialização Tecnológica',
                'Ensino superior - bacharelato ou equivalente',
                'Licenciatura Pré-Bolonha',
                'Licenciatura 1º Ciclo - Pós-Bolonha',
                'Mestrado',
                'Doutoramento'
            ]],
            [['tin', 'num_emp', 'ssn', 'zip_code'], 'string', 'max' => 20],
            [['street'], 'string', 'max' => 100],
            [['iban'], 'string', 'max' => 25,'min'=>25],
            [['tin','num_emp','ssn','zip_code','street','iban'],'trim'],
            [['num_emp'], 'unique'],
            [['ssn'], 'unique'],
            [['tin'], 'unique'],
            [['iban'], 'unique'],
            [['employee_id'], 'unique'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['employee_id' => 'id']],
            [['function_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmployeeFunction::class, 'targetAttribute' => ['function_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'ID',
            'tin' => 'Nº Contribuinte',
            'num_emp' => 'Nº Empregrado',
            'ssn' => 'Nº Segurança Social',
            'street' => 'Rua',
            'zip_code' => 'Código Postal',
            'iban' => 'Iban',
            'qualifications' => 'Qualificações',
            'function_id' => 'ID da Função',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'employee_id']);
    }

    /**
     * Gets query for [[Function]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFunction()
    {
        return $this->hasOne(EmployeeFunction::class, ['id' => 'function_id']);
    }

    /**
     * Gets query for [[SupportTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTickets()
    {
        return $this->hasMany(SupportTicket::class, ['employee_id' => 'employee_id']);
    }
}
