$(function () {
    $('#CPF').mask('000.000.000-00');
    $('#telefone').mask('(00) 90000-0000');
    $('#crm').mask('0000000');
    $('#rg').mask('0.000.000');

    $('#pushmenu').click(function () {
        $('.paragrafo').toggle();
    })
    $('.main-sidebar').mouseenter(function () {
        $('.paragrafo').show();
    })
    


}

);
