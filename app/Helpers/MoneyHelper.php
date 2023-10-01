<?php
// app/Helpers/MoneyHelper.php

if (!function_exists('formatMoney')) {
    function formatMoney($value)
    {
        return 'R$ ' . number_format($value / 100, 2, ',', '.');
    }
}

