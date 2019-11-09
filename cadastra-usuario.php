<?php

    require_once('db-connect.php');

    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $objDb = new db();
    $link = $objDb->conectBd();

    $usuario_existe = false;
    $email_existe = false;

    //Verifica se usuario existe

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";

    if($resource = mysqli_query($link, $sql)){
        
        $dados_user = mysqli_fetch_array($resource);

        if(isset($dados_user['usuario'])){
            $usuario_existe = true;
        }
    }else{
        echo 'Erro ao tentar recuperar um registro!';
    }

    //Verifica se email existe

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";

    if($resource = mysqli_query($link, $sql)){
        
        $dados_user = mysqli_fetch_array($resource);

        if(isset($dados_user['email'])){
            $email_existe = true;
        }
    }else{
        echo 'Erro ao tentar recuperar um registro!';
    }

    if($usuario_existe || $email_existe){
        $retorno_get = '';

        if($usuario_existe){
            $retorno_get.='erro_usuario=1&';
        }

        if($email_existe){
            $retorno_get.='erro_email=1&';
        }

        header('location: inscrevase.php?'.$retorno_get);
        die();
    }

    $sql = "INSERT INTO usuarios(usuario, senha, email) VALUES ('$usuario', '$senha', '$email')";
    
    //Verifica se a query possui erro de sintaxe e executa a instrução.
    if(mysqli_query($link, $sql)){
        echo 'Registro Inserido com sucesso!';

        header('location: index.php');
    }else{
        echo 'Erro!';
    }

?>