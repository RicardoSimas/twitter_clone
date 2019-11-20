<?php
       
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
    }
   
    require_once('db_connect.php');
   
    $id_usuario = $_SESSION['id'];
      
    $objDb = new Db();
       
    $link = $objDb->conectBd();

    $sql = " DELETE FROM Tweets WHERE $id_tweet = id_tweet AND $id_usuario = id_usuario ";

    mysqli_query($link, $sql);

?>