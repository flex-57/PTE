<?php
namespace App\Utils;

class StringUtils
{
    public static function mbUcfirst(?string $string): ?string
    {
        if ($string === null) {
            return null;
        }

        $firstChar = mb_strtoupper(mb_substr($string, 0, 1));
        $rest = mb_substr($string, 1);

        return $firstChar . $rest;
    }
}
