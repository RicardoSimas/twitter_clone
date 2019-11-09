<?php
    session_start();

    require_once('db-connect.php');

    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);

    $objDb = new db();

    $link = $objDb->conectBd();

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha' ";

    $resource = mysqli_query($link, $sql);
    
    //Verificação de erro de sintaxe da consulta.
    if($resource){
        //Retorna em formato de array o registro recuperado do BD.
        $dadosUsuario = mysqli_fetch_array($resource);

        if(isset($dadosUsuario['usuario'])){

            $_SESSION['usuario'] = $dadosUsuario['usuario'];
            
            header('location: home.php');

        }else{
            header('location: index.php?erro=1');
        }

    }else{
        echo 'Erro na execução da consulta!';
    }

?>