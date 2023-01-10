<?php


namespace frontend\tests\Acceptance;

use common\fixtures\UserFixture;
use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class BuyTicketCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/site/login');
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        /*$I->submitForm('#login-form', [
            'LoginForm[username]'  => 'antonio',
            'LoginForm[password]'  => '12345678',
        ]);*/

        $I->see("Login",'h1');
        $I->fillField('LoginForm[username]','user_test');
        $I->fillField('LoginForm[password]','password_0');

        $I->see("Lojas");
        $I->click("Lojas");

        $I->wait(2);

        $I->see("Hugo boss");

        $I->dontSee("Username ou Password erradas!");
        $I->dontSee("Tem de escrever uma username.");
        $I->dontSee("Tem de escrever uma password.");

        $I->see("Antonio Alberto");

        $I->seeLink("Voos");
        $I->click("Voos");

        $I->see('Reserve agora o seu voo');

        $I->submitForm('#flight-search', [
            'FlightForm[origin]' => 'ANA Aeroporto de Lisboa',
            'FlightForm[destiny]' => 'ANA Aeroporto de Faro',
            'FlightForm[passengers]' => '1',
        ]);

        $I->wait(2);

        $I->seeLink('Reservar');
        $I->click('Reservar');

        $I->wait(3);

        $I->see('Informações dos Passageiros');

        /*$I->submitForm('#flight-search', [
            'FlightForm[origin]' => 'ANA Aeroporto de Lisboa',
            'FlightForm[destiny]' => 'ANA Aeroporto de Faro',
            'FlightForm[passengers]' => '1',
        ]);*/
    }
}
