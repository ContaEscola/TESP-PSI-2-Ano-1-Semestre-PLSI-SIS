<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
    
    /**
     * @param FunctionalTester $I
     */
    public function loginUserAdmin(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
        $I->submitForm('#login-form', [
            'LoginForm[username]'  => 'rafael',
            'LoginForm[password]'  => '12345678',
        ]);

        $I->see('Rafael Bento');
        $I->see('Aeroporto');
        $I->see('Utilizadores');
        $I->see('Perdidos e achados');
        $I->see('Métodos de pagamento');
        $I->see('Restaurantes');
        $I->see('Server log');

    }

    public function loginUserEmployee(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
        $I->submitForm('#login-form', [
            'LoginForm[username]'  => 'pedro',
            'LoginForm[password]'  => '12345678',
            ]);

        $I->see('Pedro Norberto');
        $I->see('Aeroporto');
        $I->see('Clientes');
        $I->see('Perdidos e achados');
        $I->see('Métodos de pagamento');

    }
}
