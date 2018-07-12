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
    public function getNavigationReturnHtml(UnitTester $I)
    {
        $something = Stub::make(
            $this->fixture,
            [
                'getHtmlForDirectoryPath' => 'testify'
            ]
        );

        $I->assertSame('testify', $something->getNavigation());
    }
}
