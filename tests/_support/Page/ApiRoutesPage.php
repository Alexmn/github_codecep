<?php
namespace TEST\Page;

class ApiRoutesPage
{
    public static $URL         = 'https://api.github.com';
    public static $generalUrl  = 'https://api.github.com/user/repos';
    public static $specificUrl = '/repos/';
    private static $username   = 'githubCodeception';
    private static $password   = 'TestareGithub1';

    public static function getToken(): string
    {
        return base64_encode(self::$username .':'.self::$password);
    }

    public static function composePostBody($name): string
    {
        $arrayData['name'] = $name;
        $arrayData['auto_init'] = true;

        return json_encode($arrayData);
    }

    public static function getSpecificRepoActionUrl($name): string
    {
        return self::$URL . self::$specificUrl . self::$username . '/' . $name;
    }
}
