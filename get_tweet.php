<?php
       
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
    }
   
    require_once('db-connect.php');
   
    $id_usuario = $_SESSION['id'];
      
    $objDb = new Db();
       
    $link = $objDb->conectBd();
   
    $sql = "SELECT DATE_FORMAT(t.data_tweet, '%d %b %Y %T') as data_tweet, t.tweet, u.usuario FROM tweets AS t JOIN usuarios AS u ON (t.id_usuario = u.id)";
    $sql.= "WHERE id_usuario = $id_usuario OR id_usuario IN (SELECT id_usuario_seguido FROM usuarios_seguidores WHERE id_usuario = $id_usuario) ";
    $sql.= "ORDER BY data_tweet DESC ";

    $resource = mysqli_query($link, $sql);
        

    if($resource){
        while($dados_tweet = mysqli_fetch_array($resource, MYSQLI_ASSOC)){

            echo '<a href="#" class="list-group-item">';
                echo '<h4 class="list-group-item-heading"> '. $dados_tweet['usuario'].' <small> - '. $dados_tweet['data_tweet'] .' </small></h4>';
                echo '<p>'. $dados_tweet['tweet'] .'</p>';               
            echo '</a>';

            echo '<br/>';
            
        }
    }else{
        echo 'Erro ao executar a query!';
    }
?>