<?php
namespace TEST;

use Codeception\Util\HttpCode;
use TEST\ApiTester;
use TEST\Page\ApiRoutesPage;
use TEST\Step\Api\ApiRoutesStep;

class ApiRepoCest
{
    private function getRepoUsers(ApiTester $I): void
    {
        $I->amGoingTo('Interogate github in order to get all user repos');
        ApiRoutesStep::getAuthorizedApiHeaders($I);
        $I->sendGET(ApiRoutesPage::$URL);
        $I->canSeeResponseCodeIs(HttpCode::OK);
        $I->canSeeResponseIsJson();
    }

    private function createRepoResource(ApiTester $I): void
    {
        $I->amGoingTo('create first repo test');
        ApiRoutesStep::getAuthorizedApiHeaders($I);
        $I->sendPOST(ApiRoutesPage::$URL, ApiRoutesPage::composePostBody());
        $I->canSeeResponseCodeIs(HttpCode::CREATED);
    }

    public function runningPhase(ApiTester $I): void
    {
        $this->createRepoResource($I);
        $this->getRepoUsers($I);
    }
}
