<?php
//Página que exibe todos os funcionários, com funções: EDITAR e EXCLUIR
include '../../../Model/Entity/conexao.php';

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: login.php");
    exit;
} else if ($_SESSION['nivel_usuario'] != 1) {
    header("location: funcionario.php");
}

//Comando MYSQL e execução dele
$consultar = "SELECT * FROM usuarios WHERE nivel_usuario != 1";
$conex = $conexaoMysqli->query($consultar) or die($conexaoMysqli->error);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../_css/style.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="shortcut icon" href="../imgs/icon.PNG" type="image/x-icon">
    <title>Exibir Funcionários</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="brand-title">
                <a href="administrador.php">
                    <abbr title="Página Inicial">
                        <img class="img-logo" src="../imgs/logo-layoff.png" alt="Logo" width="120px">
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
                <!-- Dropdown Funcionários -->
                <li class="dropdown">
                        <a class="dropdown-toggle" href="exibir_func.php" data-bs-toggle="dropdown">
                            <strong>Funcionários <i class="fas fa-users black-color"></i> </strong>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="exibir_func.php">Exibir Funcionários</a></li>
                            <li><a class="dropdown-item" href="cadastrar_funcionario.php">Cadastrar Funcionário(a)</a></li>
                        </ul>
                    </li>
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
        <div class="d-flex justify-content-center">
            <h1>Exibir Funcionários</h1>
        </div>

        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <!-- Todos os funcionários estão sendo exibidos dentro de uma tabela -->
        <div class="container">
            <div class="table-responsive" id="tbl">
                <table class="tabela table table-bordered">
                    <thread>
                        <tr>
                            <th>Nome do Funcionário(a)</td>
                            <th>Nome de Usuário</td>
                            <th>Nivel</td>
                            <th>Status</td>
                            <th>Ações</td>
                        </tr>
                    </thread>
                    <?php
                    //Jogará os resultados para uma variável, e enquanto tiver valores não emprimidos
                    while ($stats = $conex->fetch_assoc()) {
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td class='left-align'> $stats[nome_usuario] </td>";
                        echo "<td class='left-align'> $stats[username_usuario] </td>";
                        //Se o nível do usuário for 0, ele é um funcionário
                        if ($stats['nivel_usuario'] == 0) {
                            echo "<td> Funcionário(a) </td>";
                            //Se o nível do usuário for 1, ele é um administrador
                        } else if ($stats['nivel_usuario'] == 1) {
                            echo "<td> Administrador </td>";
                        }
                        //Se o status do usuário for 1, ele está ativo
                        if ($stats['status_usuario'] == 1) {
                            echo "<td> Ativo </td>";
                            //Se o status do usuário for 0, ele está inativo
                        } else if ($stats['status_usuario'] == 0) {
                            echo "<td class='text-danger'> Inativo </td>";
                        }
                        //Botões de editar e excluir, com janela modal no excluir
                        echo "
                            <td>
                                <a class='black-color' href='editar_func.php?id_usuario=" . $stats['id_usuario'] . "'>
                                    <i class='fas fa-user-edit'></i>
                                </a>
                                <strong  style='margin: 0 10px;'>|</strong>
                                <a class='black-color' href='../../../Model/Entity/del_func.php?id_usuario=" . $stats['id_usuario'] . "' data-confirm='Tem certeza de que deseja excluir o funcionário(a) selecionado?'>
                                    <i class='fas fa-user-minus'></i>
                                </a>
                            </td>";
                        echo "<tr>";
                        echo "</tbody>";
                    }
                    ?>
                </table>
            </div>
        </div>
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