<?php
namespace TEST\Page;

class ApiRoutesPage
{
    public static $URL       = 'https://api.github.com/user/repos';
    private static $username = 'githubCodeception';
    private static $password = 'TestareGithub1';

    public static function getToken(): string
    {
        return base64_encode(self::$username .':'.self::$password);
    }

    public static function composePostBody(): string
    {
        $arrayData['name'] = "hello world - " . microtime();
        $arrayData['auto_init'] = true;

        return json_encode($arrayData);
    }

}
