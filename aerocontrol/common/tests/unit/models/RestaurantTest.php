<?php


namespace common\tests\Unit\models;

use common\models\Restaurant;
use common\tests\UnitTester;

class RestaurantTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate(){
        $this->tester->haveRecord(Restaurant::class,[
            'name' => 'restaurant_test',
            'description' => 'Restaurante de hamburguers',
            'phone' => '919300122',
            'open_time' => '05:00:00',
            'close_time' => '01:00:00',
            'logo' => 'restaurant_test_15-12-2022_20-49.png',
            'website' => 'www.restauranttest.pt'
        ]);
        $this->tester->seeRecord(Restaurant::class,['name' => 'restaurant_test']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(Restaurant::class,['name' => 'Burger King']);
    }

    public function testUpdate()
    {
        $restaurant = Restaurant::find()->where(['name' => 'Burger King'])->one();
        $restaurant->name = 'New restaurant name';
        $this->assertTrue($restaurant->save());
        $this->assertEquals('New restaurant name',$restaurant->name);
    }
}
