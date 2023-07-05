<?php

namespace App\Helpers;

class GeneralHelper
{
    public static function phoneNumberToInternational(string $phoneNumber): string
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (strlen($phoneNumber) === 10) {
            $phoneNumber = '254' . substr($phoneNumber, -9);
        }

        return $phoneNumber;
    }
}
