<?php
namespace TEST;

use Codeception\Util\HttpCode;
use TEST\ApiTester;
use TEST\Page\ApiRoutesPage;
use TEST\Step\Api\ApiRoutesStep;

class ApiRepoCest
{
    public static $name = ['repo1', 'repo2', 'repo3'];

    private function getRepoUsers(ApiTester $I): void
    {
        $I->amGoingTo('Interogate github in order to get all user repos');
        ApiRoutesStep::getAuthorizedApiHeaders($I);
        $I->sendGET(ApiRoutesPage::$URL);
        $I->canSeeResponseCodeIs(HttpCode::OK);
        $I->canSeeResponseIsJson();
    }

    private function createRepoResource(ApiTester $I, $name): void
    {
        $I->amGoingTo('create first repo test');
        ApiRoutesStep::getAuthorizedApiHeaders($I);
        $I->sendPOST(ApiRoutesPage::$generalUrl, ApiRoutesPage::composePostBody($name));
        $I->canSeeResponseCodeIs(HttpCode::CREATED);
    }

    private function deleteRepoResource(ApiTester $I, $name, $httpCode): void
    {
        $I->amGoingTo('delete repository for a given id');
        ApiRoutesStep::getAuthorizedApiHeaders($I);
        $I->sendDELETE(ApiRoutesPage::getSpecificRepoActionUrl($name));
        $I->canSeeResponseCodeIs($httpCode);
    }

    public function runningPhase(ApiTester $I): void
    {
        $this->createRepoResource($I, self::$name[0]);
        $this->createRepoResource($I, self::$name[1]);
        $this->createRepoResource($I, self::$name[2]);
        $this->getRepoUsers($I);
        $this->deleteRepoResource($I, self::$name[0], HttpCode::NO_CONTENT);
        $this->deleteRepoResource($I, self::$name[0], HttpCode::NOT_FOUND);
    }
}
