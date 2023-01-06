<?php


namespace common\tests\Unit\models;

use common\models\SupportTicket;
use common\tests\UnitTester;

class SupportTicketTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate(){
        $this->tester->haveRecord(SupportTicket::class,[
            'title' => 'ticket_test',
            'state' => 'Concluido',
            'client_id' => 5
        ]);
        $this->tester->seeRecord(SupportTicket::class,['title' => 'ticket_test']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(SupportTicket::class,['title' => 'Casisola Perdida']);
    }

    public function testUpdate()
    {
        $ticket = SupportTicket::find()->where(['title' => 'Casisola Perdida'])->one();
        $ticket->title = 'New ticket name';
        $this->assertTrue($ticket->save());
        $this->assertEquals('New ticket name',$ticket->title);
    }
}
