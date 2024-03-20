<?php

declare(strict_types=1);

namespace App\Modules\Common;

abstract class Helpers
{
    public static function nullStringToInt($str) : ?int
    {
        if ($str !== null) {
            return (int)$str;
        }

        return null;
    }
}