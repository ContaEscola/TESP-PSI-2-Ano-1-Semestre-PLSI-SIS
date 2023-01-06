<?php


namespace common\tests\Unit\models;

use common\models\TicketItem;
use common\tests\UnitTester;

class TicketItemTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate(){
        $this->tester->haveRecord(TicketItem::class,[
            'lost_item_id' => 4,
            'support_ticket_id' => 1
        ]);
        $this->tester->seeRecord(TicketItem::class,[
            'lost_item_id' => 4,
            'support_ticket_id' => 1
        ]);
    }

    public function testRead()
    {
        $this->tester->seeRecord(TicketItem::class,[
            'lost_item_id' => 1,
            'support_ticket_id' => 2
        ]);
    }

    public function testDelete()
    {
        $ticket = TicketItem::find()->where([
            'lost_item_id' => 1,
            'support_ticket_id' => 2
        ])->one();
        $ticket->delete();
        $this->tester->dontSeeRecord(TicketItem::class,[
            'lost_item_id' => 1,
            'support_ticket_id' => 2
        ]);
    }
}
