<?php
//Página para cadastrar um funcionário
include '../../../Model/Entity/conexao.php';
require_once '../../../Controller/Pages/usuarios.php';

$u = new Usuario;

session_start(); //inicia a sessão...
if (!isset($_SESSION['id_usuario'])) { //se não estiver definida, não possuir um id_usuario
    header("location: login.php"); // vai mandar ele devolta para a página de login...
    exit; //para a execução, do codigo restante...
} else if ($_SESSION['nivel_usuario'] != 1) {
    header("location: funcionario.php");
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
    <link rel="shortcut icon" href="../imgs/icon.PNG" type="image/x-icon">
    <title>Cadastrar Usuário</title>
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
            <h1>Cadastrar Funcionário</h1>
        </div>

        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <div class="container w-50 p-3 text-center">
            <form method="POST" action="">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome_func" required name="nome_usuario" placeholder="Digite o nome do funcionário(a)" maxlength="75">
                    <label for="nome_func">Nome do funcionário(a)</label>
                </div>


                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username_usuario" required name="username_usuario" placeholder="Digite o username" maxlength="75">
                    <label for="username_usuario">Nome de usuário</label>
                </div>


                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="senha_usuario" required name="senha_usuario" placeholder="Digite uma senha" maxlength="75">
                    <label for="senha_usuario">Senha</label>
                </div>


                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="confSenha_usuario" required name="confSenha_usuario" placeholder="Confirme a senha" maxlength="75">
                    <label for="confSenha_usuario">Confirme a senha</label>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <input type="submit" class="btn btn-info mt-3" value="CADASTRAR">
                    </div>
                </div>
            </form>
        </div>

        <?php
        //Verificar se clicou no botão
        if (isset($_POST['nome_usuario'])) {
            $nome_usuario = addslashes($_POST['nome_usuario']);
            $username_usuario = addslashes($_POST['username_usuario']);
            $senha_usuario = addslashes($_POST['senha_usuario']);
            $confSenha_usuario = addslashes($_POST['confSenha_usuario']);
            //Verificar se está preenchido
            if (!empty($nome_usuario) && !empty($username_usuario) && !empty($senha_usuario) && !empty($confSenha_usuario)) {
                $u->conectar("db_finecrew", "localhost", "root", "");
                if ($u->msgErro == "") { // se está vazia, está tudo certo
                    if ($senha_usuario == $confSenha_usuario) {
                        if ($u->cadastrar($nome_usuario, $username_usuario, $senha_usuario)) {
                            $_SESSION['msg'] = "<script>alert('Cadastrado com sucesso!');</script>";
                            header("location: funcionario.php");
                        } else {
                            echo "<script>alert('Nome de usuário já cadastrado!');</script>";
                        }
                    } else {
                        echo "<script>alert('Senha e confirmar senha não correspodem!');</script>";
                    }
                } else {
                    echo "Erro: " . $u->msgErro;
                }
            } else {
                echo "<script>alert('Preencha todos os campos!');</script>";
            }
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

    <script src="../../../Controller/Pages/_js/navbar.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>