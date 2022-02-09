<?php
//Arquivo com funções do login...

Class Usuario{  //criando uma classe...
    private $pdo; //atributo privado PDO...
    public $msgErro = ""; //atributo publico que contem o erro...

    public function conectar($dbnome, $servidor, $usuario, $senha){ //método/função pública que contem a conexão entre o banco de dados e a página... o que esta dentro dos (são parametros)...
        global $pdo; //para poder ser acessada...
        global $msgErro; //para poder ser acessada...
        //Try catch: uma função que é feita pra tratar de erros e falhas como exceções
        try{ //caso ocorra algum problema com o que está dentro do try...
            $pdo =  new PDO("mysql:dbname=" . $dbnome . ";host=" . $servidor, $usuario, $senha); //fazendo a conexão com o banco...
        }catch (PDOException $e) { //será redirecionado ao bloco catch...
            $msgErro = $e->getMessage(); //inserindo o erro dentro da variável...
        }
        
    }

    public function cadastrar($nome_usuario, $username_usuario, $senha_usuario){
        global $pdo;
        global $msgErro;
        //verificar se já está cadastrado
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE username_usuario = :u");
        $sql->bindValue(":u",$username_usuario); 
        $sql->execute();
        if($sql->rowCount() > 0){
            return false; //já está cadastrado
        }else {
            //caso não, cadastrar
            $sql = $pdo->prepare("INSERT INTO usuarios (nome_usuario, username_usuario, senha_usuario) VALUES (:nu, :uu, :su)");
            $sql->bindValue(":nu",$nome_usuario); 
            $sql->bindValue(":uu",$username_usuario); 
            $sql->bindValue(":su",md5($senha_usuario)); 
            $sql->execute();
            return true;//foi cadastrado com sucesso
        }

   
    }

    public function logar($usuario, $senha){ //método/função pública para logar...
        global $pdo; //para poder ser acessada...
        global $msgErro; //para poder ser acessada...

        //verificar se o email e senha estao cadastrados, se sim
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE username_usuario = :u AND senha_usuario = :s");
        $sql->bindValue(":u",$usuario); //basicamento o bindValue ele meio que abrevia, o $usuario virou: :u...
        $sql->bindValue(":s",md5($senha)); // a $senha virou: :s. E o md5, basicamente criptografa a senha do usúario, dando mais segurança...
        $sql->execute(); //vai executar...

        if($sql->rowCount() > 0){
            //entrar no sistema (sessao)
            $dado = $sql->fetch();
            session_start(); //inicia a sessão...
            $_SESSION['id_usuario'] = $dado['id_usuario']; //_SESSION recebe o id_usuario...

            $verificar = $pdo->query("SELECT * FROM usuarios WHERE id_usuario = '$_SESSION[id_usuario]'"); //cria uma variável que seleciona tudo da tabela usuarios...
            while($linha = $verificar->fetch(PDO::FETCH_ASSOC)){//a variável $linha recebe um array da variável $verificar...
                if($linha['id_usuario'] == $_SESSION['id_usuario']){ //se a variável $linha for igual ao id da sessão...
                    $nivel  = $linha['nivel_usuario']; //variável $nivel recebe o nivel de usuário...
                    $status = $linha['status_usuario'];

                    switch ($nivel && $status){//seleciona um dos casos...

                        case ($nivel == 0 && $status == 1)://Funcionário(a)
                            header("location: ../../../resources/View/Pages/funcionario.php");
                        break;

                        case ($nivel == 1 && $status == 1)://Administrador
                            header("location: ../../../resources/View/Pages/administrador.php");
                        break;

                        case ($nivel == 0 && $status == 0):
                            echo "Usuário sem aceso!";
                        break;

                        case ($nivel == 1 && $status == 0):
                            echo "Administrador sem acesso!";
                        break;

                        default://Caso não for nenhum dos dois...
                            echo "<script>alert('Usuario sem acesso!');</script>";
                            header("location: login.php");
                        break;
                    }

                    $_SESSION['nivel_usuario']  = $nivel;
                    $_SESSION['status_usuario'] = $status;
                }
            }

            return true; //ele está cadastrado, ou seja ele logou...
        } else{
            return false; //não foi possível logar...
        }
    }
}

?>