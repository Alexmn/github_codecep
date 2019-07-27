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
        $I->sendPOST(ApiRoutesPage::$generalUrl(), ApiRoutesPage::composePostBody());
        $I->canSeeResponseCodeIs(HttpCode::CREATED);
    }

    private function deleteRepoResource(ApiTester $I, $name): void
    {
        $I->amGoingTo('delete repository for a given id');
        ApiRoutesStep::getAuthorizedApiHeaders($I);
        $I->sendDELETE(ApiRoutesPage::getSpecificRepoActionUrl($nameg));
        $I->canSeeResponseCodeIs(HttpCode::NO_CONTENT);
    }

    public function runningPhase(ApiTester $I): void
    {
        $this->createRepoResource($I);
        $this->createRepoResource($I);
        $this->createRepoResource($I);
        $this->getRepoUsers($I);
        $this->deleteRepoResource($I,$name);
    }
}
