<?php
       
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('location: index.php?erro=1');
    }
   
    require_once('db_connect.php');
   
    $id_usuario = $_SESSION['id'];
      
    $objDb = new Db();
       
    $link = $objDb->conectBd();
   
    $sql = "SELECT DATE_FORMAT(t.data_tweet, '%d %b %Y %T') as data_tweet, t.id_tweet, t.tweet, u.usuario FROM tweets AS t JOIN usuarios AS u ON (t.id_usuario = u.id)";
    $sql.= "WHERE id_usuario = $id_usuario OR id_usuario IN (SELECT id_usuario_seguido FROM usuarios_seguidores WHERE id_usuario = $id_usuario) ";
    $sql.= "ORDER BY data_tweet DESC ";

    $resource = mysqli_query($link, $sql);
        
    if($resource){
        while($dados_tweet = mysqli_fetch_array($resource, MYSQLI_ASSOC)){

            echo '<a href="#" class="list-group-item">';

                echo '<h4 class="list-group-item-heading pull-left"> '.$dados_tweet['usuario'].' <small> - '. $dados_tweet['data_tweet'] .' </small></h4>';
                
                echo '<p class="list-group-item-text pull-right">';
                    echo '<button type="button" id="btn_del_tweet_'.$dados_tweet['id_tweet'].'" class="close"><span>&times;</span></button>';    
                echo '</p>';
                
                echo '<p style="clear:both">'. $dados_tweet['tweet'] .'</p>'; 

            echo '</a>';

            echo '<br/>';
        }
    }else{
        echo 'Erro ao executar a query!';
    }
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<script type="text/javascript">
			$(document).ready( function(){
			
            	$('#btn_del_tweet_'+$dados_tweet['id_tweet']){
                    alert('aa');
                }

				function updateTweet(){
					$.ajax({
						url: 'get_tweet.php',
						success: function(data){
							$('#timeline_tweet').html(data); //html do jquery é o mesmo que innerHTML do js.
						}					
					});
				}

				updateTweet();
		
			});

		</script>
	
	</head>

	<body>
	    
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
    </body>
    
</html>