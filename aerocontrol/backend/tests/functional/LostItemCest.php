<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use common\models\LostItem;

class LostItemCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('lost-item/create');
    }

    public function createLostItemEmptyForm(FunctionalTester $I)
    {
        $I->see("Criar item perdido e achado",'h1');
        $I->submitForm('#lost-item-form', []);
        $I->seeValidationError("Descrição não pode ser vazio.");
    }

    public function createLostItem(FunctionalTester $I)
    {
        $I->see("Criar item perdido e achado",'h1');
        $I->submitForm('#lost-item-form', [
            'LostItem[description]' => 'Item novo',
            'LostItem[state]' => 'Por entregar',
            'LostItem[imageFile]' => 'aaa.png',
        ]);
        $I->dontSeeValidationError("Descrição não pode ser vazio.");
        $I->dontSeeValidationError("A descrição e não pode exceder os 100 caracteres.");

        $I->seeRecord(LostItem::class, [
            'description' => 'Item novo',
            'state' => 'Por entregar',
        ]);
    }
}
