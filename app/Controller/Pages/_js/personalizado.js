$(function () {
    //Pesquisar os produtos sem refresh
    $("#pesquisa").keyup(function () {

        var pesquisa = $(this).val();

        //Verificar se a algo digitado
        if (pesquisa != "") {
            var dados = {
                palavra: pesquisa
            }
            $.post("../../../Model/Entity/busca.php", dados, function (retorna) {
                //Mostra dentro da ul os resultados obtidos
                $(".resultado").html(retorna);
            });
        } else {
            $(".resultado").html('');
        }
    });
});

var lista = document.getElementById('lista');
var pesquisa = document.getElementById('pesquisa');

function noFocus(){
    lista.style.display = "none";
    pesquisa.style.borderBottom = "1px solid #19c0d3 !important";
}

function onFocus(){
    lista.style.display = "inline";
}
