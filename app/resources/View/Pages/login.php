<!-- Página de login -->
<?php
require_once '../../../Controller/Pages/usuarios.php'; //chamando o arquivo usuarios.php...

$u = new Usuario; //adiciona uma nova classe...
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links do Bootstrap -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">

    <!-- Link do css -->
    <link rel="stylesheet" href="../_css/loginstyle.css">

    <!-- Favicon -->
    <link rel="shortcut icon" type="imagex/png" href="imgs/casa.png">

    <title>Login</title>
</head>

<body id="body">

    <!-- Tela de login -->
    <section class="h-100 gradient-form" style="background-color: #f1efef;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <!-- logo -->
                                        <img src="../imgs/logo-layoff.png" style="width: 250px;" alt="Logo Layoff. Controll" class="mb-4">
                                    </div>

                                    <!-- Formulario -->
                                    <form method="POST">

                                        <!-- Usuario -->
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="usuario" required name="usuario" maxlength="75" placeholder="Digite o usuário"> 
                                            <label for="usuario">Usuário <i class="fas fa-user"></i></i> </label>
                                        </div>

                                        <!-- Senha -->
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="senha" required name="senha" maxlength="75" placeholder="Digite a senha">
                                            <label for="senha">Senha <i class="fas fa-key"></i> </label>
                                        </div>

                                        <!-- Button -->
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <input type="submit" value="ACESSAR" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 mt-4">
                                        </div>
                                    </form>

                                    <!-- PHP -->
                                    <?php
                                    if (isset($_POST['usuario'])) { //serve para saber se uma variável está definida
                                        $usuario = addslashes($_POST['usuario']); //addslashes adiciona 
                                        $senha   = addslashes($_POST['senha']);     //uma proteção...

                                        if (!empty($usuario) && !empty($senha)) { //se as variáveis não estiverem vazias...
                                            $u->conectar("db_finecrew", "localhost", "root", ""); //conecta com o banco
                                            if ($u->msgErro == "") { //se não apresentar nenhuma mensagem de erro...
                                                if (!$u->logar($usuario, $senha)) { //se as informações não corresponderem...
                                    ?>
                                                    <div class="text-center p-3 mb-2 bg-danger text-black bg-opacity-75 rounded">
                                                        <?php echo "Credenciais incorretas!"; ?>
                                                    </div>
                                                <?php
                                                }
                                            } else { //caso existir algum erro, vai apresentar na tela...
                                                ?>
                                                <div class="text-center p-3 mb-2 bg-danger text-black bg-opacity-75 rounded">
                                                    <?php echo "Erro: " . $u->msgErro; ?>
                                                </div>
                                            <?php
                                            }
                                        } else { //se o usuário deixar algum campo vazio...
                                            ?>
                                            <div class="text-center p-3 mb-2 bg-danger text-black bg-opacity-75 rounded">
                                                <?php echo "Preencha todos os campos obrigatórios!"; ?>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <!-- Fim do PHP -->

                                </div>
                            </div>
                            <div id="azul" class="col-lg-6 d-flex align-items-center gradient-custom-2  ">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Olá, como vai?</h4>
                                    <p class="mb-4">
                                    <p>Faça login para poder utilizar o site.</p>
                                    Caso não lembre o seu usuário e a senha, contate o seu superior.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="../javascript/login.js"></script>

</html>