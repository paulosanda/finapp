<?php

if (!function_exists('convertToInteger')) {
    function convertToInteger($moneyString)
    {
        $cleanedString = preg_replace('/[^0-9.]/', '', $moneyString);

        $cleanedString = str_replace('.', '', $cleanedString);

        $intValue = (int) $cleanedString;

        return $intValue;
    }
}

