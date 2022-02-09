<?php
//Página para pesquisar produtos
include '../../../Model/Entity/conexao.php';

session_start(); //inicia a sessão...
if (!isset($_SESSION['id_usuario'])) { //se não estiver definida, não possuir um id_usuario
    header("location: login.php"); // vai mandar ele devolta para a página de login...
    exit; //para a execução, do codigo restante...
}

$consulta = "SELECT * FROM produto"; //varaivel que vai consultar o banco de dados...
$con = $conexaoMysqli->query($consulta) or die($conexaoMysqli->error); //vai fazer a conexao com outra variavel, caso der errado, vai matar a conexao...

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../_css/style.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="shortcut icon" href="../imgs/icon.PNG" type="image/x-icon">
    <title>Pesquisar Produtos</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="brand-title">
                <a href="funcionario.php">
                    <abbr title="Página Inicial">
                        <img class="img-logo" src="../imgs/logo-layoff.png" alt="Logo Layoff. Controll" width="120px">
                    </abbr>
                </a>
            </div>
            <a href="#" class="toggle-button">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>
            <div class="navbar-links">
                <ul>
                    <!-- Dropdown Categorias -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="exibir_categorias.php" data-bs-toggle="dropdown">
                            <strong>Categorias <i class="fas fa-list black-color"></i> </strong>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="exibir_categorias.php">Exibir Categorias</a></li>
                            <li><a class="dropdown-item" href="cadastrar_categoria.php">Cadastrar Categoria</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="pesquisar_produto.php" class="li-color"><strong>Pesquisar Produto <i class="fas fa-search black-color"></i> </strong></a>
                    </li>
                    <li>
                        <a href="requisicao.php" class="li-color"><strong>Requisição <i class="fas fa-utensils black-color"></i> </strong></a>
                    </li>
                    <li>
                        <a href="cadastrar_produto.php" class="li-color"><strong>Cadastrar Produto <i class="fas fa-plus-circle black-color"></i> </strong></a>
                    </li>
                    <li>
                        <a class="sair-li" href="../../../Controller/Pages/sair.php"><strong class="black-color"> Sair <i class="fas fa-sign-out-alt"></i> </strong>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <form method="POST" action="">
                <div class="row justify-content-md-center">
                    <div class="col-sm-4 my-4" id="div-pesquisa">
                        <div class="input-group">
                            <!-- Input para pesquisar -->
                            <input id="input-pesq" class="form-control" name="nome_produto" type="text" placeholder="Digite o nome do produto...">
                            <div class="input-group-btn">
                                <button id="btn-pesq" class="btn btn-default" type="submit" name="pesquisarProduto">
                                    <!-- Img dentro do button -->
                                    <img src="https://img.icons8.com/external-dreamstale-lineal-dreamstale/32/000000/external-search-seo-dreamstale-lineal-dreamstale-7.png" width="67%" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-center">
            <h1 style="margin-top: 0;">Produtos</h1>
        </div>

        <?php
        //Codigos para pesquisar o produto...
        $pesquisarProduto = filter_input(INPUT_POST, 'pesquisarProduto', FILTER_SANITIZE_STRING);
        $nome_produto = filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_STRING);
        $result_produto = "SELECT * FROM produto WHERE nome_produto LIKE '%$nome_produto%'";
        $resultado_produto = mysqli_query($conexaoMysqli, $result_produto);
        //Se a variavel esta definida, vai chamar os codigos para pesquisar...
        if (isset($_POST["pesquisarProduto"])) {
            //Se a variavel esta está vazia...
            if (empty($nome_produto)) {
                //Vai emprimir um alert, e a tabela na tela do usuario...
                echo "<script>alert('Preencha o campo para pesquisar!');</script>";
            } else {
                //Se a pesquisa der certo...
                if (($resultado_produto) and ($resultado_produto->num_rows != 0)) {
        ?>
                    <div class="text-center">
                        <p style='color:green;'>Esses foram os resultados...</p>
                    </div>
                    <!-- Tabela -->
                    <div class="container">
                        <div class="table-responsive" id="tbl">
                            <table class="tabela table table-bordered border border-white">
                                <thread>
                                    <tr>
                                        <th>Produto</td>
                                        <th>Quantidade</td>
                                        <th>Entrega</td>
                                        <th>Validade</td>
                                        <th>Observação</td>
                                        <th>Categoria</td>
                                        <th>Ações</td>
                                    </tr>
                                </thread>
                                <?php
                                //Imprimindo a tabela...
                                while ($dados = mysqli_fetch_assoc($resultado_produto)) {
                                    //para emprimir o nome da categoria...
                                    $busca_categoria = "SELECT nome_categoria FROM categorias_de_produtos WHERE id_categoria = '$dados[id_categoria]'";
                                    $buscou = $conexaoMysqli->query($busca_categoria);
                                    $categoria = $buscou->fetch_assoc();
                                    echo "<tr>";
                                    echo "<td class='left-align'>" . $dados['nome_produto'] . "</td>";
                                    $search = ",";
                                    $dados['quantidade_produto'] = str_replace(".", ",", $dados['quantidade_produto']);
                                    if (strpos($dados['quantidade_produto'], $search) !== false) {
                                        echo "<td> $dados[quantidade_produto] <abbr title='Quilos'>Kg</abbr> </td>";
                                    } else {
                                        echo "<td> $dados[quantidade_produto] <abbr title='Unidades'>Un</abbr> </td>";
                                    }
                                    echo "<td>" . date("d/m/Y", strtotime($dados['entrega_produto'])) . "</td>";
                                    echo "<td>" . date("d/m/Y", strtotime($dados['validade_produto'])) . "</td>";
                                    echo "<td class='left-align'>" . $dados['observacao_produto'] . "</td>";
                                    echo "<td class='left-align'>" . $categoria['nome_categoria'] . "</td>";
                                    echo "
                                        <td> 
                                            <a class='black-color' href='editar_produto.php?id_produto=" . $dados['id_produto'] . "'>
                                                <strong class='btn-editar'>
                                                    EDITAR 
                                                </strong> <i class='fas fa-pen'></i> 
                                            </a> 
                                            | 
                                            <a class='black-color' href='../../../Model/Entity/del_produto.php?id_produto=" . $dados['id_produto'] . "' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>
                                                <strong class='btn-excluir'>
                                                    EXCLUIR 
                                                </strong> <i class='fas fa-trash'></i>
                                            </a> 
                                        </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                <?php
                } else {
                    echo "<script>alert('Este produto ainda não foi cadastrado, ou nome incorreto!');</script>";
                }
            }
        }
        //Caso ocorrer algum erro, vai imprimir uma msg nessa variavel...
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
                ?>
    </main>

    <!-- Rodapé -->
    <footer>
        <div class="cont">
            <div class="sobre isso">
                <h2>Sobre</h2>
                <p>
                    Esse site foi desenvolvido pelo Squad Fine Crew, com 4 integrantes, sendo eles: Allyfer, Kevin, Maria Eduarda e Paulo.<br>
                    O objetivo dele é ajudar e facilitar o trabalho do setor da cozinha do Marista Ir. Acácio.
            </p>
            </div>
            <div class="sobre links">
                <h2>Precisa de ajuda?</h2>
                <ul>
                    <li><a href="#"><i class="far fa-question-circle"></i> Clique aqui</a></li>
                </ul>
            </div>
            <div class="sobre contato">
                <h2>Contatos</h2>
                <ul class="info">
                    <li>
                        <p>
                        <a href="#"><i class="fab fa-instagram"></i> Allyfer - Front-End</a><br>
                        <a href="#"><i class="fab fa-instagram"></i> Kevin - Back-End e Front-End</a><br>
                        <a href="#"><i class="fab fa-instagram"></i> Maria Eduarda - Design</a><br>
                        <a href="#"><i class="fab fa-instagram"></i> Paulo Henrique - Front-End</a><br>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../../../Controller/Pages/_js/controller.js"></script>
    <script src="../../../Controller/Pages/_js/navbar.js"></script>

</body>

</html>