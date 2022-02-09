<?php
//Arquivo para editar funcionários
session_start(); 

include_once 'conexao.php'; 

$id_usuario       = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT); 
$nome_usuario     = filter_input(INPUT_POST, 'nome_usuario', FILTER_SANITIZE_STRING);
$username_usuario = filter_input(INPUT_POST, 'username_usuario', FILTER_SANITIZE_STRING);
//$senha_usuario    = filter_input(INPUT_POST, 'senha_usuario', FILTER_SANITIZE_STRING);
$nivel_usuario    = filter_input(INPUT_POST, 'nivel_usuario', FILTER_SANITIZE_NUMBER_INT);
$status_usuario   = filter_input(INPUT_POST, 'status_usuario', FILTER_SANITIZE_NUMBER_INT);

//Comando MYSQL e execução dele
$results_usuario = "UPDATE usuarios SET nome_usuario = '$nome_usuario', username_usuario = '$username_usuario', nivel_usuario = '$nivel_usuario', status_usuario = '$status_usuario' WHERE id_usuario = '$id_usuario'";
$resultados_usuario = mysqli_query($conexaoMysqli, $results_usuario); 

//Se afetar alguma linha no bd
if(mysqli_affected_rows($conexaoMysqli)){
    $_SESSION['msg'] = "<p style='color:green;'>O Usuário foi editado com sucesso!</p>";
    header("Location: ../../resources/View/Pages/exibir_func.php");
    
//Se não afetar nenhuma linha no bd
} else{
    $_SESSION['msg'] = "<p style='color:red;'>ERRO: O Usuário não foi editado!</p>";
    header("Location: ../../../resources/View/Pages/editar_func.php?id=$id_usuario"); 
}
?>