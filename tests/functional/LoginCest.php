<?php

namespace Tests\Functional;

use Tests\Support\FunctionalTester;

class LoginCest
{
    public function tryLogin(FunctionalTester $I)
    {
//        $I = new WebGuy($scenario);
//        $I->wantTo('log in as regular user');
        $I->amOnPage('/');
//                $I->click('Login');

        $I->see('laravel');
//        $I->fillField('Password','qwerty');
//        $I->see('Hello, davert');
    }

    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
}
