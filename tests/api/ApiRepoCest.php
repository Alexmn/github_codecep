<?php
namespace TEST;

use Codeception\Util\HttpCode;
use TEST\ApiTester;
use TEST\Page\ApiRoutesPage;
use TEST\Step\Api\ApiRoutesStep;

class ApiRepoCest
{
    public function _before(ApiTester $I)
    {
        if($this->getRepoUsers($I) != [])
        {
            $this->deleteRepoResource($I, ApiRoutesPage::$repoName[1], HttpCode::NO_CONTENT);
            $this->deleteRepoResource($I, ApiRoutesPage::$repoName[2], HttpCode::NO_CONTENT);
        }
    }

//    public function _after(ApiTester $I)
//    {
//        if($this->getRepoUsers($I) != [])
//        {
//            $this->deleteRepoResource($I, ApiRoutesPage::$repoName[1], HttpCode::NO_CONTENT);
//            $this->deleteRepoResource($I, ApiRoutesPage::$repoName[2], HttpCode::NO_CONTENT);
//        }
//    }

    private function getRepoUsers(ApiTester $I): string
    {
        $I->amGoingTo('Interogate github in order to get all user repos');
        ApiRoutesStep::getAuthorizedApiHeaders($I);
        $I->sendGET(ApiRoutesPage::$URL);
        $I->canSeeResponseCodeIs(HttpCode::OK);
        $I->canSeeResponseIsJson();

        return $I->grabResponse();
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
        $I->amGoingTo('delete specified repository ' . $name);
        ApiRoutesStep::getAuthorizedApiHeaders($I);
        $I->sendDELETE(ApiRoutesPage::getSpecificRepoActionUrl($name));
        $I->canSeeResponseCodeIs($httpCode);
    }

    public function runningPhase(ApiTester $I): void
    {
        $this->createRepoResource($I, ApiRoutesPage::$repoName[0]);
        $this->createRepoResource($I, ApiRoutesPage::$repoName[1]);
        $this->createRepoResource($I, ApiRoutesPage::$repoName[2]);
        $this->deleteRepoResource($I, ApiRoutesPage::$repoName[0], HttpCode::NO_CONTENT);
        $this->deleteRepoResource($I, ApiRoutesPage::$repoName[0], HttpCode::NOT_FOUND);
        $result = $this->getRepoUsers($I);

//        $this->deleteRepoResource($I, ApiRoutesPage::$repoName[1], HttpCode::NO_CONTENT);
//        $this->deleteRepoResource($I, ApiRoutesPage::$repoName[2], HttpCode::NO_CONTENT);
    }
}
