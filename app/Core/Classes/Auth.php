<?php

namespace Beejee\App\Core\Classes;

use Beejee\App\Core\Constants;

class Auth
{
    public static function check()
    {
        if (isset($_COOKIE[Constants::COOKIE_AUTH_NAME]) && $_COOKIE[Constants::COOKIE_AUTH_NAME] === Constants::AUTH_TOKEN) return true;

        return false;
    }

    protected static function makeHash($login, $pass)
    {
        return md5(md5($pass).":".$login);
    }

    public static function auth($login, $password)
    {
        if ($login === Constants::LOGIN && self::makeHash($login,$password) === Constants::HASH_PASSWORD ) {
            $authToken = self::makeHash($login, $login);
            $_COOKIE[Constants::COOKIE_AUTH_NAME] = $authToken;
            setcookie(Constants::COOKIE_AUTH_NAME, $authToken,  time()+24000, "/");

            return true;
        }

        return false;
    }

    public static function logout()
    {
        unset($_COOKIE[Constants::COOKIE_AUTH_NAME]);
        setcookie(Constants::COOKIE_AUTH_NAME, "",  time()-3600, "/");
    }
}