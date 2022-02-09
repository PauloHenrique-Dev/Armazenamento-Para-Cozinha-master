<?php
//Página para editar um funcionário
include_once '../../../Model/Entity/conexao.php';

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: login.php");
    exit;
} else if ($_SESSION['nivel_usuario'] != 1) {
    header("location: funcionario.php");
}

//Recebe o ID, e em outra possui comando MYSQL e a execução dele, jogando os resultados para uma variável que será um array
$id_usuario = filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);
$result_usuarios = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";
$resultado_usuarios = mysqli_query($conexaoMysqli, $result_usuarios);
$linha_usuarios = mysqli_fetch_assoc($resultado_usuarios);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../_css/style.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="shortcut icon" href="../imgs/icon.PNG" type="image/x-icon">
    <title>Editar Funcionário</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="brand-title">
                <abbr title="Página Inicial">
                    <img class="img-logo" src="../imgs/logo-layoff.png" alt="Logo" width="120px">
                </abbr>
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
            <h1>Editar Funcionário</h1>
        </div>

        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <div class="container w-25 p-3">
            <form method="POST" action="../../../Model/Entity/edit_func.php">
                <input type="hidden" name="id_usuario" value="<?php echo $linha_usuarios['id_usuario']; ?>">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="nome_usuario" onkeyup="comparar()" id="nome" value="<?php echo $linha_usuarios['nome_usuario']; ?>">
                    <label for="nome">Nome do Funcionário(a)</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username_usuario" onkeyup="comparar()" id="username" value="<?php echo $linha_usuarios['username_usuario']; ?>">
                    <label for="username">Nome de Usuário</label>
                </div>

                <div class="form-floating">
                    <select class="form-select" name="nivel_usuario" onmouseleave="comparar()" id="nivel">
                        <!-- Option para colocar o nível de usuário  -->
                        <?php
                        if ($linha_usuarios['nivel_usuario'] == 0) {
                            echo "
                                <option value='0' selected>Funcionário</option>
                                <option value='1'>Administrador</option>
                                ";
                        }
                        ?>
                    </select>
                    <label for="id">Nivel de Usuário</label>
                </div>

                <div class="form-floating mt-3">
                    <select class="form-select" name="status_usuario" onmouseleave="comparar()" id="status">
                        <!-- Option para mudar o status do usuário -->
                        <?php
                        if ($linha_usuarios['status_usuario'] == 1) {
                            echo "
                                <option value='1' selected>Ativo</option>
                                <option value='0'>Inativo</option>
                                ";
                        } else {
                            echo "
                                <option value='1'>Ativo</option>
                                <option value='0' selected>Inativo</option>
                                ";
                        }
                        ?>
                    </select>
                    <label>Status de Usuário</label>
                </div>

                <abbr title="Altere um dos campos..." id="abbr">
                    <div class="row">
                        <div class="col text-center">
                            <input type='submit' class="btn btn-info mt-4" name='botao' id="botao" value='SALVAR' disabled>
                        </div>
                    </div>
                </abbr>
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

    <!-- Para ativar o button caso houver alguma alteração -->
    <!-- Pegando os valores originais, com Javascript dentro do PHP...-->
    <?php
    $script =
        "<script>
                var nome_or    = '$linha_usuarios[nome_usuario]';
                var usuario_or = '$linha_usuarios[username_usuario]';
                var nivel_or   = '$linha_usuarios[nivel_usuario]';
                var status_or  = '$linha_usuarios[status_usuario]';
            </script>";
    echo $script;
    ?>

    <!-- Função que compara os valores antigos e os novos -->
    <script>
        function comparar() {
            //Variáveis que possuem os novos valores (caso houver)
            var nome_novo = document.getElementById('nome').value;
            var usuario_novo = document.getElementById('username').value;
            //var senha_novo   = document.getElementById('senha').value;
            var nivel_novo = document.getElementById('nivel');
            var value = nivel_novo.options[nivel_novo.selectedIndex].value;
            var status_novo = document.getElementById('status');
            var value1 = status_novo.options[status_novo.selectedIndex].value;

            //Colocando o botao em uma variavel
            var button = document.getElementById('botao');
            var abbr = document.getElementById('abbr');

            //Estrutura de decisão caso houver alguma modificação em um dos campos
            if (nome_or === nome_novo && usuario_or === usuario_novo && nivel_or === value && status_or === value1) {
                //Se não, o botão continua desativado
                button.setAttribute('disabled', 'disabled');
                abbr.setAttribute('title', 'Altere um dos campos...');
            } else if (nome_novo === "" || usuario_novo === "" || nivel_novo === "" || status_novo === "") {
                button.setAttribute('disabled', 'disabled');
                abbr.setAttribute('title', 'Não deixe nenhum campo vazio!');
            } else {
                //Se sim, o botão é ativado
                button.removeAttribute('disabled');
                abbr.setAttribute('title', 'Clique para salvar as alterações!');
            }
        }
    </script>
    <script src="../../../Controller/Pages/_js/navbar.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>