<?php
       
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
    }
   
    require_once('db-connect.php');
    
    $people_name = $_POST['name_people'];
    $id_usuario = $_SESSION['id'];
      
    $objDb = new Db();
    $link = $objDb->conectBd();
   
    $sql = " SELECT * FROM usuarios WHERE usuario like '%$people_name%' AND id != '$id_usuario' ";
    $resource = mysqli_query($link, $sql);
        
    if($resource){
        while($dados_usuario = mysqli_fetch_array($resource, MYSQLI_ASSOC)){

            echo '<a href="#" class="list-group-item">';
               echo '<strong> '.$dados_usuario['usuario'].' </strong> <small> - '.$dados_usuario['email'].' </small>';  
               
               echo '<p class="list-group-item-text pull-right">';
                    echo '<button type="button" class="btn-follow btn btn-default btn-xs" data-id_usuario="'.$dados_usuario['id'].'">Seguir</button>';
               echo '</p>';
               echo '<div class="clearfix"></div>';      
            echo '</a>';
          

            echo '<br />';
        }
    }else{
        echo 'Erro ao executar a query!';
    }
?>