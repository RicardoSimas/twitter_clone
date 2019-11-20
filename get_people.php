<?php
       
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
    }
   
    require_once('db_connect.php');
    
    $people_name = $_POST['name_people'];
    $id_usuario = $_SESSION['id'];
      
    $objDb = new Db();
    $link = $objDb->conectBd();
   
    $sql = " SELECT * FROM usuarios as u ";
    $sql.= " LEFT JOIN usuarios_seguidores as us ON (us.id_usuario = $id_usuario AND u.id = us.id_usuario_seguido) ";
    $sql.= " WHERE usuario LIKE '%$people_name%' AND u.id <> $id_usuario;" ;


    $resource = mysqli_query($link, $sql);
        
    if($resource){
        while($dados_usuario = mysqli_fetch_array($resource, MYSQLI_ASSOC)){

            echo '<a href="#" class="list-group-item">';
               echo '<strong> '.$dados_usuario['usuario'].' </strong> <small> - '.$dados_usuario['email'].' </small>';  
               
               echo '<p class="list-group-item-text pull-right">';

                    $follow_user_sn = isset($dados_usuario['id_user_seguidores']) && !empty($dados_usuario['id_user_seguidores']) ? 'S' : 'N';
                    $btn_follow_display = 'block';
                    $btn_unfollow_display = 'block';

                    if($follow_user_sn == 'N'){
                        $btn_unfollow_display = 'none';
                    }else{
                        $btn_follow_display = 'none';
                    }

                    echo '<button type="button" id="btn_follow_'.$dados_usuario['id'].'" style="display: '.$btn_follow_display.'" class="btn-follow btn btn-default btn-xs" data-id_usuario_seguido="'.$dados_usuario['id'].'">Follow</button>';
                    echo '<button type="button" id="btn_unfollow_'.$dados_usuario['id'].'" style="display: '.$btn_unfollow_display.'" class="btn-unfollow btn btn-primary btn-xs" data-id_usuario_seguido="'.$dados_usuario['id'].'">Unfollow</button>';

               echo '</p>';
               echo '<div class="clearfix"></div>';      
            echo '</a>';
          

            echo '<br />';
        }
    }else{
        echo 'Erro ao executar a query!';
    }
?>