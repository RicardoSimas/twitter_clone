<?php

    require_once('db-connect.php');

    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $objDb = new db();

    $link = $objDb->conectBd();

    $sql = "INSERT INTO usuarios(usuario, senha, email) VALUES ('$usuario', '$senha', '$email')";
    
    //Verifica se a query possui erro de sintaxe e executa a instrução.
    if(mysqli_query($link, $sql)){
        echo 'Registro Inserido com sucesso!';
    }else{
        echo 'Erro!';
    }

?>