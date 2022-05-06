<?php

namespace Beejee\App\Core\Classes;

class Redirects
{
    public static function redirect($to)
    {
        header('Location: '.$to);
        return true;
    }
}