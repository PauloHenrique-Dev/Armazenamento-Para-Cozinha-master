<?php
//Página que fará a requisição
session_start(); //inicia a sessão...
if (!isset($_SESSION['id_usuario'])) { //se não estiver definida, não possuir um id_usuario
    header("location: login.php"); // vai mandar ele devolta para a página de login...
    exit; //para a execução, do codigo restante...
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
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css' type='text/css'>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../_css/style.css">
    <link rel="stylesheet" href="../_css/pesquisa.css">
    <link rel="shortcut icon" href="../imgs/icon.PNG" type="image/x-icon">
    <title>Requisição</title>
</head>

<body>
    <header>
        <nav class="navbar" style="padding-right: 16px; padding-left: 16px;">
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
                    <li style="padding-left: 0;">
                        <a href="pesquisar_produto.php" class="li-color"><strong>Pesquisar Produto <i class="fas fa-search black-color"></i> </strong></a>
                    </li>
                    <li style="padding-left: 0;">
                        <a href="requisicao.php" class="li-color"><strong>Requisição <i class="fas fa-utensils black-color"></i> </strong></a>
                    </li>
                    <li style="padding-left: 0;">
                        <a href="cadastrar_produto.php" class="li-color"><strong>Cadastrar Produto <i class="fas fa-plus-circle black-color"></i> </strong></a>
                    </li>
                    <li style="padding-left: 0;">
                        <a class="sair-li" href="../../../Controller/Pages/sair.php"><strong class="black-color"> Sair <i class="fas fa-sign-out-alt"></i> </strong>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="msg">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>

        <br>

        <div class="container text-center">
            <form method="POST" id="form-pesquisa" action="">
                <div class="row justify-content-md-center">
                    <div class="col-sm-4 centralized">
                        <div class="search">
                            <input type="search" class="form-control pesquisinha" name="pesquisa" id="pesquisa" placeholder="Pesquisar..." onfocus="onFocus()">
                            <div id="lupa"></div>
                            <div class="list" id="lista">
                                <ul class="resultado">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <div class="d-flex justify-content-center">
            <h1 style="margin-top: 1%;">Requisição</h1>
        </div>

        <div class="container">
            <form method='POST' action='../../../Model/Entity/requisita.php'>
                <div class="table-responsive" id="tbl">
                    <table class="tabela table table-bordered" id="trueTbl">
                        <thead>
                            <tr>
                                <td><strong>Produto</strong></td>
                                <td><strong>Quantidade Disponível</strong></td>
                                <td><strong>Requisição</strong></td>
                                <td><strong>Excluir</strong></td>
                            </tr>
                        </thead>

                    </table>
                </div>


                <div id="div">

                </div>

                <br>

                <div class="row">
                    <div class="col text-center" style="margin-bottom: 121px;">
                        <input type="submit" name="botao" class="btn btn-info mt-4" value="Requisitar">
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

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../../Controller/Pages/_js/personalizado.js"></script>
    <script src="../../../Controller/Pages/_js/navbar.js"></script>
</body>

</html>