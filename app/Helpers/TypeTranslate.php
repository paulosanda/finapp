<?php

if(!function_exists('typeTranslate')) {
    function typeTranslate($value): string
    {
        return ($value === 'credit') ? 'CRÉDITO' : 'DÉBITO';
    }
}
