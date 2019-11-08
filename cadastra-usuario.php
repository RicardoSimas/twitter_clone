<?php

    require_once['db-connect.php'];

    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $objDb = new db();

    $link = db->conectBd();

    $sql = "INSERT INTO usuarios('usuario', 'email', 'senha') VALUES ('$usuario, $email, $senha')";
    
    //Verifica se a query possui erro de sintaxe e executa a instrução.
    if(mysqli_query($link, $sql)){
        echo 'Registro Inserido com sucesso!'
    }else{
        echo 'Erro!'
    }

?>