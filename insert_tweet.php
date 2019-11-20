<?php
    
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
	}

    require_once('db_connect.php');

    $tweet = $_POST['text_tweet'];
    $id_usuario = $_SESSION['id'];

    if($tweet == '' || $id_usuario == ''){ 
        die();
    }

    $objDb = new Db();
    
    $link = $objDb->conectBd();

    $sql = "INSERT INTO tweets(id_usuario, tweet) VALUES($id_usuario, '$tweet')";

    mysqli_query($link, $sql);

?>  