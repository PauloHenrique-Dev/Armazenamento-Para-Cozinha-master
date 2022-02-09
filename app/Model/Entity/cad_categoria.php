<?php
//Arquivo de código para cadastrar uma categoria nova
session_start();

include_once 'conexao.php';

$busca = "SELECT nome_categoria FROM categorias_de_produtos";
$result = mysqli_query($conexaoMysqli, $busca);
$resu = mysqli_fetch_assoc($result);

$categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);

//Comando do MYSQL, e execução do comando
$insert_categoria = "INSERT INTO categorias_de_produtos (nome_categoria) VALUES ('$categoria')";

//Estrutura de decisão para adicionar uma nova categoria
if ($categoria == "") {
    //Se estiver vazio a variável
    echo "<script>alert('Por favor, preencha o campo com um nome válido!');</script>";
    echo "<script>window.location.href = '../../../resources/View/Pages/cadastrar_categoria.php';</script>";
} else if ($categoria == $resu['nome_categoria']) {
    //Se a categoria já existir
    echo "<script>alert('Essa categoria já existe!');</script>";
    echo "<script>window.location.href = '../../../resources/View/Pages/cadastrar_categoria.php';</script>";
} else {
    //Senão, executa
    $result = mysqli_query($conexaoMysqli, $insert_categoria);
    //Se afetar alguma linha
    if (mysqli_affected_rows($conexaoMysqli)) {
        $_SESSION['msg'] = "<p style='color:green;'>Uma nova Categoria foi adicionada com sucesso!</p>";
        header("Location: ../../../resources/View/Pages/exibir_categorias.php");
    } else {
        //Senão
        $_SESSION['msg'] = "<p style='color:red;'>Erro ao adicionar nova Categoria!</p>";
        header("Location: ../../../resources/View/Pages/exibir_categorias.php");
    }
}
