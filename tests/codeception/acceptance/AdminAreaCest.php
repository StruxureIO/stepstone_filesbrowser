<?php

namespace stepStone\humhub\modules\filesbrowser\codeceptionTest\acceptance;

use stepStone\humhub\modules\filesbrowser\codeceptionTest\AcceptanceTester;

class AdminAreaCest
{

    public function testAdminInfoPage(AcceptanceTester $I)
    {
        $I->wantTo('see admin info page');
        $I->amAdmin();
        $I->amOnRoute(['/filesbrowser/admin/index']);
        $I->waitForText('Welcome to the admin only area.');
    }

}
