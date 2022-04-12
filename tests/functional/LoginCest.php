<?php

namespace Tests\Functional;

use App\Models\User;
use Tests\Support\FunctionalTester;

class LoginCest
{
    public function tryLogin(FunctionalTester $I)
    {
//        $I = new WebGuy($scenario);
//        $I->wantTo('log in as regular user');
//        $I->disableMiddleware();
//$I = New User;
//$I->

//        $I = new TestGuy($scenario);
        $I->wantTo('check a page is resistant to POST injection');
        $I->amOnPage('/search');

        $I->sendPOST(
            array(
                'search' => 'fff',
            ));
        $I->see('Search results');
        $I->dontSee('Dodgy command executed');
//        $I->amOnRoute('posts.index');
//        $I->click('Login');
//        $I->fillField('name', 'Miles');
//        $I->fillField('email', 'Davis@g.om');
//        $I->seeLink('register');
//        $I->canSeeLink('login');
//        $I->see('');
//        $I->submitForm('form', ['name' => 'john', 'password' => '123456']);
//        $I->fillField('#email', 'john');
//        $I->fillField('#password', '123456');
//        $I->seeInField('email');
//        $I->click('log in');

//        $I->fillField('Password','qwerty');
//        $I->see('laravel');
    }

    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
}
