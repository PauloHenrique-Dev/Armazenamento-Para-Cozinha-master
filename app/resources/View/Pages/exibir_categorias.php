<?php
//Página que exibe todas as categorias, e com funções: EDITAR | EXCLUIR
include '../../../Model/Entity/conexao.php';

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: login.php");
    exit;
}

//definindo a quantidade de itens por página
$itens_por_pagina = 10;
//pegar página atual
@$pagina = intval($_GET['pagina']);

$consult = "SELECT * FROM categorias_de_produtos LIMIT $pagina, $itens_por_pagina";
$conexao = $conexaoMysqli->query($consult) or die($conexaoMysqli->error);
$num = $conexao->num_rows;

//pega a quantidade total de itens no banco de dados
$num_total = $conexaoMysqli->query("SELECT * FROM categorias_de_produtos")->num_rows;

//definir numero de paginas
$num_paginas = ceil($num_total / $itens_por_pagina);

?>

<!DOCTYPE html>
<html lang="pr-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../_css/style.css">
    <link rel="shortcut icon" href="../imgs/icon.PNG" type="image/x-icon">
    <title>Excluir Categoria</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="brand-title">
                <abbr title="Página Inicial">
                    <a href="funcionario.php">
                        <img class="img-logo" src="../imgs/logo-layoff.png" alt="Logo Layoff. Controll" width="120px">
                    </a>
                </abbr>
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


    <main style="margin-bottom: 20px;">
        <div class="d-flex justify-content-center">
            <h1>Categorias</h1>
        </div>

        <?php
        if (isset($_SESSION['msg'])) { //msg se
            echo $_SESSION['msg'];     //deu certo
            unset($_SESSION['msg']);   //ou nao
        }
        ?>

        <!-- Tudo será exibido em uma tabela -->
        <div class="container">
            <div class="table-responsive">
                <table class="tabela table table-bordered">
                    <thread>
                        <tr>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thread>
                    <?php
                    //Enquanto tiver itens no array, será imprimido, junto com duas funções: EDITAR e EXCLUIR
                    while ($info = $conexao->fetch_assoc()) {
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td> $info[nome_categoria] </td>";
                        echo "<td>
                                <a href='editar_categoria.php?id_categoria=" . $info['id_categoria'] . "'>
                                    <i class='fas fa-edit black-color'></i> 
                                </a>
                                <strong  style='margin: 0 10px;'>|</strong>
                                <a href='../../../Model/Entity/dell_categoria.php?id_categoria=" . $info['id_categoria'] . "' data-confirm='Tem certeza de que deseja excluir a categoria selecionada?'>
                                    <i class='fas fa-trash black-color'></i> 
                                </a>
                             </td>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </main>

    <nav aria-label="...">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a href="exibir_categorias.php?pagina=0" class="page-link">Anterior</a>
            </li>
            <?php 
                for($i=0; $i<$num_paginas; $i++){
                    if($pagina == $i){
                        echo "<li class='page-item active'>
                            <a class='page-link' href='exibir_categorias.php?pagina=$i'>
                                " . $i+1 . "
                            </a>
                        </li>";
                    } else{
                        echo "<li class='page-item'>
                            <a class='page-link' href='exibir_categorias.php?pagina=$i'>
                                " . $i+1 . "
                            </a>
                        </li>";
                    }
                } ?>
            <li class="page-item">
                <a href="exibir_categorias.php?pagina=<?php echo $num_paginas-1; ?>" class="page-link" href="#">Próxima</a>
            </li>
        </ul>
    </nav>

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