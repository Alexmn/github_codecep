<?php
namespace TEST;

use Codeception\Util\HttpCode;
use TEST\ApiTester;
use TEST\Page\ApiRoutesPage;
use TEST\Step\Api\ApiRoutesStep;

class ApiRepoCest
{
    public function getRepoUsers(ApiTester $I)
    {
        $I->amGoingTo('Interogate github in order to get all user repos');
        ApiRoutesStep::getAuthorizedApiHeaders($I);
        $I->sendGET(ApiRoutesPage::$URL);
        $I->canSeeResponseCodeIs(HttpCode::OK);
        $I->canSeeResponseIsJson();
    }
}
