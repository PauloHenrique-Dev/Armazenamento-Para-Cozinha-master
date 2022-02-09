<?php
//Arquivo pra busca sem refresh da página requisição funcionar, mas inclui outros codigos da página também...
include_once 'conexao.php';

session_start();

//Recuperar o valor da palavra
$produtos = $_POST['palavra'];

//Pesquisar no banco de dadoso nome do curso referente a palavra digitada
$produtos = "SELECT * FROM produto WHERE nome_produto LIKE '%$produtos%'";
$resultado_produtos = mysqli_query($conexaoMysqli, $produtos);

//Se nenhuma linha for buscada
if (mysqli_num_rows($resultado_produtos) <= 0) {
    echo "Nenhum produto encontrado...";
} else {
    //Se buscar alguma, vai imprimir um <li> com o resultado buscado por meio de um array, e do lado um botão pra mandar pra tabela
    while ($rows = mysqli_fetch_assoc($resultado_produtos)) {
        $name = $rows['id_produto'];
        echo "<li class='left-align list' id='" . $name . "' value='" . $rows['nome_produto'] . "' name='" . $name . "'>" . $rows['nome_produto'] .
            " <button name='$rows[quantidade_produto]' class='botao_add' id='" . $rows['nome_produto'] . "' onclick='adicionou(id, name), desabilitar(id), noFocus()' value=''> <abbr class='cursor-pointer' title='Clique para adicionar a lista'><i class='fas fa-plus black-color'></i></abbr>  </button> </li>";
    }

    //Código de Javascript dentro de um echo
    //Básicamente algumas funções de javascript
    $script = "
        <script>
            //Essa função irá adicionar na tabela, o nome do produto, um input com a quantidade do produto e outro input para fazer a requisição
            function adicionou(nome, qntd){
                var tbl = document.getElementById('trueTbl');
                var div = document.getElementById('div');

                var tbody         = document.createElement('tbody');
                var novoTr        = document.createElement('tr');
                var inputHidden   = document.createElement('input');
                var novoTd        = document.createElement('td');
                var novaInputQntd = document.createElement('td');
                var inputReq      = document.createElement('td');
                var excluir       = document.createElement('button');
                var abbrExcluir   = document.createElement('abbr');
                var iconExcluir   = document.createElement('i');
        
                novoTd.innerHTML        = nome;
                novaInputQntd.innerHTML = '<input name=qnt[] type=number class=input-table value=' + qntd + ' readonly>';
                inputReq.innerHTML      = '<input name=req[] type=number class=input-table step=.01 required>';
                excluir.innerHTML       = '';

                inputHidden.type  = 'hidden';
                inputHidden.name  = 'escondido[]';
                inputHidden.value = nome;

                abbrExcluir.title = 'Clique para deletar da lista';

                novoTr.classList.add('no-border-top');
                novoTd.classList.add('left-align');
                excluir.classList.add('no-border');
                abbrExcluir.classList.add('cursor-pointer');
                iconExcluir.classList.add('fas');
                iconExcluir.classList.add('fa-minus-circle');
                iconExcluir.classList.add('black-color');

                excluir.setAttribute('onclick', 'excluir(event.target)');

                div.appendChild(inputHidden);

                tbl.appendChild(tbody);
                tbody.appendChild(novoTr);

                novoTr.appendChild(novoTd);
                novoTr.appendChild(novaInputQntd);
                novoTr.appendChild(inputReq);
                novoTr.appendChild(excluir);
                
                excluir.appendChild(abbrExcluir);
                
                abbrExcluir.appendChild(iconExcluir);
            }

            //Essa função desabilita o botão pra adicionar na tabela, é ativada quando clicar no botão pra add
            function desabilitar(id){
                var botao = document.getElementById(id);
                botao.setAttribute('disabled', 'disabled');
            }

            //Essa função irá deletar a linha da tabela selecionada
            function excluir(elementoClicado){
                elementoClicado.closest('tr').remove();
            }
        </script>";

    //Esse echo imprime tudo da variável
    echo $script;
}
