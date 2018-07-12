<?php

use Codeception\Stub;

class PageCest
{
    public $fixture;
    public function _before(UnitTester $I)
    {
        $this->fixture = new \gfu\Page();
    }

    // tests
    public function getAdminContentReturnRightHtml(UnitTester $I)
    {
        $db = Stub::make(
            \gfu\Db::class,
            [
                'getTable' => [
                    0 => [
                        'password' => 'testify'
                    ]
                ]
            ]
        );

        $this->fixture = Stub::make(
            $this->fixture,
            [
                'db' => $db
            ]
        );

        $I->assertSame('testify', $this->fixture->getAdminContent());
    }
}
