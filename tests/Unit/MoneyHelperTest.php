<?php

use App\Helpers\MoneyHelper;
use Tests\TestCase;

it('formata um valor monetário corretamente', function () {
    $valor = 12345;

    $resultado = formatMoney($valor);

    expect($resultado)->toBe('R$ 123,45');
});

