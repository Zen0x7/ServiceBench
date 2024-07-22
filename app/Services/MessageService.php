<?php

namespace App\Services;

class MessageService
{
    public static function toString(int $first, int $second): string
    {
        $array = [$first, $second];
        sort($array);

        return implode('_', $array);
    }
}
