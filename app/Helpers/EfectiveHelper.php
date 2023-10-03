<?php

if(!function_exists('efectiveTransaction')) {
    function efectiveTransaction($value)
    {
        if($value == true) {
            return 'Sim';
        } else {
            return 'Agendada';
        }
    }
}
