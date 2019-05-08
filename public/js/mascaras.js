$(document).ready(function () { 
    var $campoCpf = $("#cpf");
    $campoCpf.mask('000.000.000-00', {reverse: true});

    var $campoCEP = $("#cep");
    $campoCEP.mask('00000-000', {reverse: true});
});