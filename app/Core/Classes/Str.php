<?php

namespace Beejee\App\Core\Classes;

class Str
{
    public static function clear($string)
    {
        return htmlspecialchars($string, null, null, false);
    }
}