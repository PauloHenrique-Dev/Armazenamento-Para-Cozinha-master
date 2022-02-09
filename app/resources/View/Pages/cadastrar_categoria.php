<?php
//Página para cadastrar uma categoria
include '../../../Model/Entity/conexao.php';

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../_css/style.css">
    <link rel="stylesheet" href="../_css/cads.css">
    <link rel="shortcut icon" href="../imgs/icon.PNG" type="image/x-icon">
    <title>Cadastrar Categoria</title>
</head>

<body>
    <header>
        <nav class="navbar" style="padding-right: 16px; padding-left: 16px;">
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
                        <a href="pesquisar_produto.php" class="li-color"><strong>  Pesquisar Produto <i class="fas fa-search black-color"></i> </strong></a>
                    </li>
                    <li>
                        <a href="requisicao.php" class="li-color"><strong> Requisição <i class="fas fa-utensils black-color"></i> </strong></a>
                    </li>
                    <li>
                        <a href="cadastrar_produto.php" class="li-color"><strong> Cadastrar Produto <i class="fas fa-plus-circle black-color"></i> </strong></a>
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
            <h1>Cadastrar Categoria</h1>
        </div>

        <div class="msg">
            <?php
            //Caso ocorrer algum erro, vai imprimir uma msg nessa variavel...
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>
        <div class="container w-25 p-3">
            <form method="POST" action="../../../Model/Entity/cad_categoria.php">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="novaCategoria" required name="categoria" maxlength="75" placeholder="Digite o nome da categoria">
                    <label for="novaCategoria">Nome da Categoria</label>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <input class="btn btn-info mt-4" type="submit" value="Cadastrar">
                    </div>
                </div>
            </form>
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

    <script src="../../../Controller/Pages/_js/navbar.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>