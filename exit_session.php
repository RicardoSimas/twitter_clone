<?php
    session_start();

    //Elimina o índice passado de um array.
    unset($_SESSION['usuario']);

    header('location: index.php')

?>