<?php
//Arquivo de código para deletar um funcionário
session_start();

include_once 'conexao.php';

$id_usuario = filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);

//Se tiver um ID
if(!empty($id_usuario)){
    
    //Comando MYSQL em uma variável e excução dele
    $result = "DELETE FROM usuarios WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($conexaoMysqli, $result);
    
    //Se afetar alguma linha no bd
    if(mysqli_affected_rows($conexaoMysqli)){
        $_SESSION['msg'] = "<p style='color:green;'>O Usuário foi excluído com sucesso!</p>";
        header("Location: ../../../resources/View/Pages/exibir_func.php");

    //Senão afetar nenhuma linha do bd
    } else{
        $_SESSION['msg'] = "<p style='color:red;'>ERRO: O Usuário não foi excluído!</p>";
        header("Location: ../../../resources/View/Pages/exibir_func.php");
    }

//Senão tiver um ID
} else{
    $_SESSION['msg'] = "<p style='color:yellow;'>Necessário selecionar um Usuário!</p>";
    header("Location: ../../../resources/View/Pages/exibir_func.php");
    }
?>