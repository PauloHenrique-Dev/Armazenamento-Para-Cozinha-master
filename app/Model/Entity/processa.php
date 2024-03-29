<?php
//Arquivo para cadastrar produtos
session_start();

include_once 'conexao.php';

$nome_produto = filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_STRING);
$categoria_produto = filter_input(INPUT_POST, 'categoria_produto', FILTER_SANITIZE_STRING);
$quantidade_produto = filter_input(INPUT_POST, 'quantidade_produto', FILTER_SANITIZE_STRING);
$validade_produto = filter_input(INPUT_POST, 'validade_produto', FILTER_SANITIZE_STRING);
$entrega_produto = filter_input(INPUT_POST, 'entrega_produto', FILTER_SANITIZE_STRING);
$observacao_produto =  filter_input(INPUT_POST, 'observacao_produto', FILTER_SANITIZE_STRING);

$busca_produtos = "SELECT nome_produto FROM produto WHERE nome_produto = '$nome_produto'";
$exec = mysqli_query($conexaoMysqli, $busca_produtos);

//Cadastrando o produto na tabela produto, e tentando fazer uma inserção na tabela controle e na controle_produto, se der certo a inserção da tabela produto...
$insert_produto = "INSERT INTO produto (nome_produto, quantidade_produto, entrega_produto, validade_produto, observacao_produto, id_categoria) VALUES ('$nome_produto', '$quantidade_produto', '$entrega_produto', '$validade_produto', '$observacao_produto', '$categoria_produto')"; //Insere os valores na tabela produto...

if ($nome_produto == "" || $categoria_produto == "" || $quantidade_produto == "" || $validade_produto == "" || $entrega_produto == "") {
    echo "<script>alert('Preencha todos os campos!');</script>";
    echo "<script>window.location.href = '../../resources/View/Pages/cadastrar_produto.php';</script>";

} else if (mysqli_num_rows($exec) >= 1) {
    echo "<script>alert('Esse produto já existe!');</script>";
    echo "<script>window.location.href = '../../resources/View/Pages/Funcionario.php';</script>";
    
} else if (mysqli_query($conexaoMysqli, $insert_produto)) { //se der certo a execução do comando insert...
    $insert_controle = "INSERT INTO controle (dataCriacao_controle, observacao_controle, id_usuario) VALUES (NOW(), '$observacao_produto', '$_SESSION[id_usuario]')"; //Insere os valores na tabela controle...

    if (mysqli_query($conexaoMysqli, $insert_controle)) { //se der certo a execução do comendo insert...
        //Buscando o id do produto, pra futuramente por em outra tabela com o $_SESSION...
        $select_produto = "SELECT id_produto FROM produto WHERE nome_produto = '$nome_produto'"; //seleciona o id da tabela produto onde o nome do produto seja igual da variável...
        $busca = $conexaoMysqli->query($select_produto); //faz uma solicitação pro banco, faz o código e o banco conversarem...
        $produto = $busca->fetch_assoc(); //transforma a variável em um array, e armazena em outra variável...
        $_SESSION['id_produto'] = $produto['id_produto']; //passa o id_produto do array, para o $_SESSION['id_produto'] ($_SESSION: é meio que uma variável global)...

        //Buscando o id do controle, pra futuramente por em outra tabela com o $_SESSION...
        $select_controle = "SELECT id_controle FROM controle WHERE observacao_controle = '$observacao_produto'"; //seleciona o id da tabela controle onde a observação seja igual a da variável
        $busca1 = $conexaoMysqli->query($select_controle); //faz uma solicitação pro banco, faz o código e o banco conversarem...
        $controle = $busca1->fetch_assoc(); //transforma a variável em um array, e armazena em outra váriavel..
        $_SESSION['id_controle'] = $controle['id_controle']; //passa o id_produto do array, para o $_SESSION['id_controle']...

        $insert_controle_produto = "INSERT INTO controle_produto (id_controle, id_produto) VALUES ('$_SESSION[id_controle]', '$_SESSION[id_produto]')"; //Insere os valores na tabela controle_produto...

        mysqli_query($conexaoMysqli, $insert_controle_produto); //executa o insert na tabela...
    }

    //Mensagem caso ocorra tudo certo, e realoca pra página inicial...
    echo "<script>alert('Um novo produto foi cadastrado!');</script>";
    echo "<script>window.location.href = '../../resources/View/Pages/Funcionario.php';</script>";
} else {
    //Mensagem caso de algum problema, e realoca para a página inicial...
    $_SESSION['msg'] = "<p style='color:red;'>ERRO: O Produto não foi cadastrado!</p>";
    header("Location: ../../resources/View/Pages/Funcionario.php");
}
