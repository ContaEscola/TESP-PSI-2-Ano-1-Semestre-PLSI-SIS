<?php


namespace common\tests\Unit\models;

use common\models\Company;
use common\tests\UnitTester;

class CompanyTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate(){
        $this->tester->haveRecord(Company::class,[
            'name' => 'company_test',
            'state' => 1
        ]);
        $this->tester->seeRecord(Company::class,['name' => 'company_test']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(Company::class,['name' => 'TAP Portugal']);
    }

    public function testUpdate()
    {
        $company = Company::find()->where(['name' => 'TAP Portugal'])->one();
        $company->name = 'New Company name';
        $this->assertTrue($company->save());
        $this->assertEquals('New Company name',$company->name);
    }
}
