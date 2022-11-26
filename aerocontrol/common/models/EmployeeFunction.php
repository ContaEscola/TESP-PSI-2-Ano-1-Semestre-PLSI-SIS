<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employee_function".
 *
 * @property int $id
 * @property string $name
 *
 * @property Employee[] $employees
 */
class EmployeeFunction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%employee_function}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'trim'],
            ['name', 'string', 'max' => 50],
            ['name', 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::class, ['function_id' => 'id']);
    }


    /**
     * Get all employeeFunctions IDs
     * @return array
     */
    public static function getPossibleEmployeeFunctionsIDs()
    {
        $possibleEmployeeFunctions = self::find()->select(['id'])->all();

        // Makes an array of ID´s from all the possible employee functions
        return ArrayHelper::getColumn($possibleEmployeeFunctions, 'id');
    }

    /**
     * Get all the employeeFunctions for dropdowns
     * @return array
     */
    public static function getPossibleEmployeeFunctionsForDropdowns()
    {
        $possibleEmployeeFunctions = self::find()->select(['id', 'name'])->all();

        // Maps the array containing the employeeFunctions to an associative array of 'id' => 'name'
        return ArrayHelper::map($possibleEmployeeFunctions, 'id', 'name');
    }
}
