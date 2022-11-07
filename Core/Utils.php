<?php

namespace App\Core;

class Utils
{
    public static function millisecondToMinSecFormat(int $milliseconde): string
    {

        $uSec = $milliseconde % 1000;
        $input = floor($milliseconde / 1000);

        $seconds = $input % 60;
        $input = floor($input / 60);

        $minutes = $input % 60;
        $input = floor($input / 60);

        return $minutes.':'.$seconds;
    }
}