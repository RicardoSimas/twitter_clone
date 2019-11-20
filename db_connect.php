<?php
class db{

    //Informações de conexão com o BD mysql;
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'twitter_clone';

    public function conectBd(){
        // Criando conexão com o BD;
        $con = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        //Ajustando o charset;
        mysqli_set_charset($con, 'utf-8');

        if(mysqli_connect_errno()){
            echo 'Erro de conexão com o BD. ' .mysqli_connect_errno();
        }

        return $con;
    }
}
?>