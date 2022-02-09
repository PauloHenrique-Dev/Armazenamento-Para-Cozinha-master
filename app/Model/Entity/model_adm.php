<?php
$adm_header = "
    <!DOCTYPE html>
    <html lang='pt-BR'>

    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <!-- Bootstrap CSS -->
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
        <title>Página Inicial</title>
        <link rel='stylesheet' href='../_css/style.css'>
        <link rel='shortcut icon' href='../imgs/icon.PNG' type='image/x-icon'>
    </head>

    <body>
        <header>
            <nav class='navbar'>
                <div class='brand-title'>
                    <img class='img-logo' src='../imgs/logo-layoff.png' alt='Logo' width='120px'>
                </div>
                <a href='#' class='toggle-button'>
                    <span class='bar'></span>
                    <span class='bar'></span>
                    <span class='bar'></span>
                </a>
                <div class='navbar-links'>
                    <ul>
                        <li>
                            <a href='exibir_func.php'><strong>Funcionários</strong></a>
                        </li>
                        <li>
                            <a href='exibir_categorias.php'><strong>Categorias</strong></a>
                        </li>
                        <li>
                            <a href='pesquisar_produto.php'><strong>Pesquisar Produto</strong></a>
                        </li>
                        <li>
                            <a href='requisicao.php'><strong>Requisição</strong></a>
                        </li>
                        <li>
                            <a href='cadastrar_produto.php'><strong>Cadastrar Produto</strong></a>
                        </li>
                        <li>
                            <a class='sair-li' href='../../../Controller/Pages/sair.php'><strong>Sair</strong>
                                <img class='sair-img' src='https://img.icons8.com/external-sbts2018-mixed-sbts2018/58/000000/external-logout-social-media-basic-1-sbts2018-mixed-sbts2018.png' width='30%'/>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
";
?>