<?php

namespace App\Services;

class ValidatorService
{
    public function alpha($string): bool
    {
        if (!empty($string) && ctype_alpha($string) && strlen($string) >= 2)
        {
            return true;
        }
        return false;
    }

    public function digit($string): bool
    {
        if (!empty($string) && ctype_digit($string)) {
            return true;
        }
        return false;
    }
}
