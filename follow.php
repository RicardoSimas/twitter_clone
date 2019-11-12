<?php
    
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
	}

    require_once('db-connect.php');

    $id_usuario = $_SESSION['id'];
    $id_user_seguidores = $_POST['id_user_seguidores'];

    if($id_usuario == '' || $id_user_seguidores == ''){ 
        die();
    }

    $objDb = new Db();
    
    $link = $objDb->conectBd();

    $sql = "INSERT INTO usuarios_seguidores(id_usuario, id_user_seguidores) VALUES($id_usuario, $id_user_seguidores)";

    mysqli_query($link, $sql);

?>  