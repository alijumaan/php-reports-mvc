<?php

namespace App\Helpers;

class RandomStringHelper
{
    public static function randomString($n): string
    {
        $characters = '0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ';
        $str = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $str .= $characters[$index];
        }

        return $str;
    }
}