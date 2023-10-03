<?php

if (!function_exists('convertToInteger')) {
    function convertToInteger($moneyString)
    {
        // Remova todos os caracteres não numéricos, exceto o ponto
        $cleanedString = preg_replace('/[^0-9.]/', '', $moneyString);

        // Remova qualquer ponto adicional
        $cleanedString = str_replace('.', '', $cleanedString);

        // Converta para inteiro
        $intValue = (int) $cleanedString;

        return $intValue;
    }
}

