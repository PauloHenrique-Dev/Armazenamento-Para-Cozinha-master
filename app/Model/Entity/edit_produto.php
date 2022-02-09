<?php
session_start(); //inicia a sessão...

include_once 'conexao.php'; //incluindo o arquivo de conexão....

//Variáveis que pegam os novos valores na input
$id_produto         = filter_input(INPUT_POST, 'id_produto',         FILTER_SANITIZE_NUMBER_INT);
$nome_produto       = filter_input(INPUT_POST, 'nome_produto',       FILTER_SANITIZE_STRING);
$quantidade_produto = filter_input(INPUT_POST, 'quantidade_produto', FILTER_SANITIZE_STRING);
$validade_produto   = filter_input(INPUT_POST, 'validade_produto',   FILTER_SANITIZE_STRING);
$entrega_produto    = filter_input(INPUT_POST, 'entrega_produto',    FILTER_SANITIZE_STRING);
$observacao_produto = filter_input(INPUT_POST, 'observacao_produto', FILTER_SANITIZE_STRING);
$id_categoria       = filter_input(INPUT_POST, 'categoria_produto',  FILTER_SANITIZE_NUMBER_INT);

//Comando MYSQL de UPDATE
$result_produto = "UPDATE produto SET nome_produto = '$nome_produto', quantidade_produto = '$quantidade_produto', validade_produto = '$validade_produto', entrega_produto = '$entrega_produto', observacao_produto = '$observacao_produto', id_categoria = '$id_categoria' WHERE id_produto = '$id_produto'";

//Comando MYSQL e execução dele
$busca_produto = "SELECT id_produto FROM produto WHERE nome_produto = '$nome_produto'";
$exec = mysqli_query($conexaoMysqli, $busca_produto);

//Estrutura de decisão, caso o nome já exista
if (mysqli_num_rows($exec) >= 2) {
    echo "<script>alert('Esse produto já existe!');</script>";
    echo "<script>window.location.href = '../../../resources/View/Pages/editar_produto.php?id_produto=$id_produto'</script>";
//Senão, executa o update
} else if ($resultado_produto = mysqli_query($conexaoMysqli, $result_produto)) {
    $_SESSION['msg'] = "<p style='color:green;'>O Produto foi editado com sucesso!</p>";
    header("Location: ../../resources/View/Pages/funcionario.php");
//Se não afetar nenhuma linha    
} else {
    $_SESSION['msg'] = "<p style='color:red;'>ERRO: O Produto não foi editado!</p>";
    header("Location: ../../../resources/View/Pages/editar_produto.php?id=$id_produto");
}