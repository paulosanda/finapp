function formatCurrency(input) {
    let valor = input.value.replace(/\D/g, '');

    if (valor.length === 1) {
        input.value = '0,0' + valor;
    } else if (valor.length === 2) {
        input.value = '0,' + valor;
    } else {
        input.value =  formatThousandsDecimal(valor);
    }
}

function  formatThousandsDecimal(valor) {
    const centavos = valor.substr(-2);
    const milhar = valor.substr(0, valor.length - 2);

    return milhar.replace(/^0+/, '') + ',' + centavos;
}

