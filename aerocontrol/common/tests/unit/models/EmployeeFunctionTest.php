<?php


namespace common\tests\Unit\models;

use common\models\EmployeeFunction;
use common\tests\UnitTester;

class EmployeeFunctionTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate(){
        $this->tester->haveRecord(EmployeeFunction::class,[
            'name' => 'employee_function_test',
        ]);
        $this->tester->seeRecord(EmployeeFunction::class,['name' => 'employee_function_test']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(EmployeeFunction::class,['name' => 'Limpeza']);
    }

    public function testUpdate()
    {
        $employeeFunction = EmployeeFunction::find()->where(['name' => 'Limpeza'])->one();
        $employeeFunction->name = 'New Function name';
        $this->assertTrue($employeeFunction->save());
        $this->assertEquals('New Function name',$employeeFunction->name);
    }
}
