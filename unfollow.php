<?php
    
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
	}

    require_once('db_connect.php');

    $id_usuario = $_SESSION['id'];
    $id_usuario_unfollow = $_POST['id_usuario_unfollow'];

    if($id_usuario == '' || $id_usuario_unfollow == ''){ 
        die();
    }

    $objDb = new Db();
    
    $link = $objDb->conectBd();

    $sql = " DELETE FROM usuarios_seguidores WHERE id_usuario = $id_usuario AND id_usuario_seguido = $id_usuario_unfollow ";

    mysqli_query($link, $sql);

?>  