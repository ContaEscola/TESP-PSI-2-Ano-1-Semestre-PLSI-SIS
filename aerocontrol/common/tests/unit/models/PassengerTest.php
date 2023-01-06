<?php


namespace common\tests\Unit\models;

use common\models\Passenger;
use common\tests\UnitTester;

class PassengerTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(Passenger::class, [
            'name' => 'Manuel',
            'gender' => 'Masculino',
            'extra_baggage' => 1,
            'seat' => 'A2',
            'flight_ticket_id' => 1,
        ]);
        $this->tester->seeRecord(Passenger::class, ['name' => 'Manuel']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(Passenger::class, ['name' => 'Manuel Santos']);
    }

    public function testUpdate()
    {
        $passenger = $this->tester->grabRecord(Passenger::class, [
            'name' => 'Manuel Santos'
        ]);
        $passenger->name = 'New name';
        $this->assertTrue($passenger->save());
        $this->assertEquals('New name', $passenger->name);
    }
}
