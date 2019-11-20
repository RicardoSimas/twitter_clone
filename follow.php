<?php
    
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
	}

    require_once('db_connect.php');

    $id_usuario = $_SESSION['id'];
    $id_usuario_seguido = $_POST['id_usuario_seguido'];

    if($id_usuario == '' || $id_usuario_seguido == ''){ 
        die();
    }

    $objDb = new Db();
    
    $link = $objDb->conectBd();

    $sql = "INSERT INTO usuarios_seguidores(id_usuario, id_usuario_seguido) VALUES($id_usuario, $id_usuario_seguido)";

    mysqli_query($link, $sql);

?>  