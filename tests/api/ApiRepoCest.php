<?php namespace TEST;

use Codeception\Util\HttpCode;
use http\Params;
use PharIo\Manifest\Url;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use TEST\ApiTester;

class ApiRepoCest
{
    const URL = 'https://developer.github.com';

    public function _before(ApiTester $I)
    {
    }

    public function getRepo(ApiTester $I)
    {
        $I->amGoingTo('intergotate github for first check api');
        $I->sendGET(self::URL);
        $I->canSeeResponseCodeIs(HttpCode::OK);
    }
}
