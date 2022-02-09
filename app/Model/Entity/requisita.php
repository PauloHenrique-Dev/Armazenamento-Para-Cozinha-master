<?php
//Arquivo que fará a requisição
include_once 'conexao.php';

session_start();

if (isset($_POST['botao'])) {
        @$qntDisp      = $_POST['qnt'];
        @$requisicao   = $_POST['req'];
        @$nome_produto = $_POST['escondido'];

        if (empty($qntDisp)) {
            echo "<script>alert('Por favor, selecione algum item para fazer uma requisição!');</script>";
            echo "<script>window.location.href = '../../resources/View/Pages/requisicao.php';</script>";
        } else {
            for ($i = 0; $i < count($requisicao); $i++) {
                $busca = "SELECT id_produto, quantidade_produto FROM produto WHERE nome_produto = '$nome_produto[$i]'";
                $resultados = mysqli_query($conexaoMysqli, $busca);

                while ($resu = mysqli_fetch_assoc($resultados)) {
                    $id = $resu['id_produto'];

                    if ($requisicao[$i] < 0) {
                        echo "<script>alert('Por favor preencha um ou mais campos da requisição!');</script>";
                        echo "<script>window.location.href = '../../resources/View/Pages/requisicao.php';</script>";
                    } else if ($requisicao[$i] > $qntDisp[$i]) {
                        echo "<script>alert('O valor desejado é maior do que o dísponivel!');</script>";
                        echo "<script>window.location.href = '../../resources/View/Pages/requisicao.php';</script>";
                    } else {
                        $sub[$i] = $qntDisp[$i] - $requisicao[$i];
                        $subtr = "UPDATE produto SET quantidade_produto = '$sub[$i]' WHERE id_produto = '$id'";

                        if (mysqli_query($conexaoMysqli, $subtr)) {
                            $insert_requisicao = "INSERT INTO requisicao (data_requisicao, id_produto, id_usuario) VALUES (NOW(), '$id', '$_SESSION[id_usuario]')";

                            if (mysqli_query($conexaoMysqli, $insert_requisicao)) {
                                $select_req = "SELECT id_requisicao FROM requisicao WHERE id_produto = '$id' AND data_requisicao = NOW()";
                                $busca = $conexaoMysqli->query($select_req);
                                $req = $busca->fetch_assoc();

                                $insert_requisicaoProduto = "INSERT INTO requisicao_produto (quantidade, id_requisicao, id_produto) VALUES ('$requisicao[$i]', '$req[id_requisicao]', '$id')";

                                if (mysqli_query($conexaoMysqli, $insert_requisicaoProduto)) {
                                    echo "<script>alert('A requisição foi feita com sucesso!');</script>";
                                    echo "<script>window.location.href = '../../resources/View/Pages/funcionario.php'</script>";
                                }
                            }
                        } else {
                            $_SESSION['msg'] = "<p style='color:red;'>A Requisição falhou!</p>";
                            header("location: requisicao.php");
                        }
                    }
                }
            }
        }
    }

