<?php
namespace TEST\Step\Api;

use TEST\ApiTester;
use TEST\Page\ApiRoutesPage;

class ApiRoutesStep extends ApiTester
{

    public static function getAuthorizedApiHeaders(ApiTester $I): void
    {
        $I->haveHttpHeader('Accept', 'application/vnd.github.v3+json');
        $I->haveHttpHeader('Authorization', 'Basic ' . ApiRoutesPage::getToken());
    }
}