<?php
//Página para editar um produto
include_once '../../../Model/Entity/conexao.php';

session_start(); //inicia a sessão...
if (!isset($_SESSION['id_usuario'])) { //se não estiver definida, não possuir um id_usuario
    header("location: login.php"); // vai mandar ele devolta para a página de login...
    exit; //para a execução, do codigo restante...
}

$id_produto = filter_input(INPUT_GET, 'id_produto', FILTER_SANITIZE_NUMBER_INT); //variavel armazenando o id com um filtro...
$result_produto = "SELECT * FROM produto WHERE id_produto = '$id_produto'"; //variavel que possui o id do produto selecionado para editar...
$resultado_produto = mysqli_query($conexaoMysqli, $result_produto); //variavel que faz a conexão...
$linha_produto = mysqli_fetch_assoc($resultado_produto); // variavel que fez um array, que armazena os itens dentro dela...

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>

<body>
    <a href="funcionario.php">Voltar</a>
    <h1>Editar Produto</h1>

    <?php
    if (isset($_SESSION['msg'])) { //msg se
        echo $_SESSION['msg'];    //deu certo
        unset($_SESSION['msg']);   //ou nao
    }
    ?>
    <form method="POST" action="../../../Model/Entity/edit_produto.php" name="myForm" id="form">

        <input type="hidden" name="id_produto" value="<?php echo $linha_produto['id_produto']; ?>">

        <label>Produto: </label>
        <input type="text" name="nome_produto" id="nome" onkeyup="comparar()" value="<?php echo $linha_produto['nome_produto']; ?>"><br><br>

        <label>Quantidade: </label>
        <input type="number" name="quantidade_produto" id="quantidade" step=".01" onkeyup="comparar()" value="<?php echo $linha_produto['quantidade_produto']; ?>"><br><br>

        <label>Data de entrega: </label>
        <input type="date" name="entrega_produto" id="entrega" onkeyup="comparar()" value="<?php echo $linha_produto['entrega_produto']; ?>" min="2022-01-01"><br><br>

        <label>Data de Validade: </label>
        <input type="date" name="validade_produto" id="validade" onkeyup="comparar()" value="<?php echo $linha_produto['validade_produto']; ?>" min="2022-01-01"><br><br>

        <label>Observação: </label>
        <input type="text" name="observacao_produto" id="observacao" onkeyup="comparar()" value="<?php echo $linha_produto['observacao_produto']; ?>"><br><br>

        <label>Categoria: </label>
        <select name="categoria_produto" id="categoria" onmouseleave="comparar()">

            <!-- Option com PHP que mostrará todas as categorias que possui, e já virá selecionada a que o produto possui atualmente -->
            <?php
            //Comando MYSQL e execução dele
            $result_categoria = "SELECT * FROM categorias_de_produtos";
            $resultado_categoria = mysqli_query($conexaoMysqli, $result_categoria);

            //Jogará os resultados dentro de uma variável, que será um array, e enquanto tiver resultados nela
            while ($row_categoria = mysqli_fetch_assoc($resultado_categoria)) { ?>
                <?php if ($row_categoria['id_categoria'] == $linha_produto['id_categoria']) {
                    echo "<option value='" . $row_categoria['id_categoria'] . "' selected>" . $row_categoria['nome_categoria'] . "</option>";
                } else { ?>
                    <option value="<?php echo $row_categoria['id_categoria'] ?>">
                        <?php echo $row_categoria['nome_categoria']; ?>
                    </option> <?php
                            }
                        }
                                ?>

        </select><br><br>

        <abbr title="Altere um dos campos..." id="abbr">
            <input type='submit' name='botao' id="botao" value='SALVAR' disabled>
        </abbr>

        <!-- Para ativar o button caso houver alguma alteração -->
        <!-- Pegando os valores originais, com Javascript dentro do PHP...-->
        <?php
        $script =
            "<script>
                var produto_or    = '$linha_produto[nome_produto]';
                var quantidade_or = '$linha_produto[quantidade_produto]';
                var entrega_or    = '$linha_produto[entrega_produto]';
                var validade_or   = '$linha_produto[validade_produto]';
                var observacao_or = '$linha_produto[observacao_produto]';
                var categoria_or  = '$linha_produto[id_categoria]';
            </script>";
        echo $script;
        ?>

        <!-- Função que compara os valores antigos e os novos -->
        <script>
            function comparar() {
                //Variáveis que possuem os novos valores (caso houver)
                var produto_novo = document.getElementById('nome').value;
                var quantidade_novo = document.getElementById('quantidade').value;
                var entrega_novo = document.getElementById('entrega').value;
                var validade_novo = document.getElementById('validade').value;
                var observacao_novo = document.getElementById('observacao').value;
                var categoria_novo = document.getElementById('categoria').value;

                //Colocando o botao em uma variavel
                var button = document.getElementById('botao');
                var abbr   = document.getElementById('abbr');

                //Estrutura de decisão caso houver alguma modificação em um dos campos
                if (produto_or === produto_novo && quantidade_or === quantidade_novo && entrega_or === entrega_novo && validade_or === validade_novo && observacao_or === observacao_novo && categoria_or === categoria_novo) {
                    //Se não, o botão continua desativado
                    button.setAttribute('disabled', 'disabled');
                    abbr.setAttribute('title', 'Altere um dos campos...');
                } else if(produto_novo === "" || quantidade_novo === "" || entrega_novo === "" || validade_novo === "" || categoria_novo === ""){
                    //Se o usuário deixar algum campo obrigatório vazio
                    button.setAttribute('disabled', 'disabled');
                    abbr.setAttribute('title', 'Não deixe nenhum campo obrigatório vazio!');
                } else{
                    //Se sim, o botão é ativado
                    button.removeAttribute('disabled');
                    abbr.setAttribute('title', 'Clique para salvar as alterações...');
                }
            }
        </script>

    </form>

</body>

</html>