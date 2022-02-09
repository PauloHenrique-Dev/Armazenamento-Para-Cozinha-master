<?php
//Arquivo para deletar um produto
session_start(); //inicia a sessão...

include_once 'conexao.php'; //incluindo o arquivo de conexão....

$id_produto = filter_input(INPUT_GET, 'id_produto', FILTER_SANITIZE_NUMBER_INT);

//Se a variavel não estiver vazia... Vai executar o if e deletar o que pedir...
if(!empty($id_produto)){
    $result_produto = "DELETE FROM produto WHERE id_produto = '$id_produto'";
    $resultado_produto = mysqli_query($conexaoMysqli, $result_produto);
    
    //Imprimi uma mensagem de erro e realoca a pessoa para a area privada...
    if(mysqli_affected_rows($conexaoMysqli)){
        $_SESSION['msg'] = "<p style='color:green;'>O produto foi excluído com sucesso!</p>";
        header("Location: ../../resources/View/Pages/Funcionario.php");

    //Imprimi na tela uma mensagem de sucesso e realoca a pessoa para a area privada...
    } else{
        $_SESSION['msg'] = "<p style='color:red;'>ERRO: O Produto não foi excluído!</p>";
        header("Location: ../../resources/View/Pages/Funcionario.php");
    }

//Se der um erro, faltar o ID, imprimi uma mensagem e realoca para a area privada...
} else{
    $_SESSION['msg'] = "<p style='color:yellow;'>Necessário selecionar um produto!</p>";
    header("Location: ../../resources/View/Pages/Funcionario.php");
    }
?>