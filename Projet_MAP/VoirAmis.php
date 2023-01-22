<?php
    session_start();

    if(isset($_SESSION['LOGGED_USERNAME'])){
        $user = $_SESSION['LOGGED_USERNAME'];

        $con = new mysqli('localhost', 'root', 'root','test');
        if($con->connect_error){
            die("Connection Failed : ".$con->connect_error);
        }else{
            $stmt = $con->prepare("select * from amis where monNom = ?");
            $stmt->bind_param("s",$user);
            $stmt->execute();
            $stmt_result= $stmt->get_result();
            if($stmt_result->num_rows > 0){
                $data = $stmt_result->fetch_assoc();
                print_r($data);
                /* for($i = 0; $i < 5; $i++){
                    array_push($array, $data);
                    var_dump($array);
                } */
                    
                    $_SESSION['AMIS_FOUND'] = $data;
                    /* var_dump($_SESSION['AMIS_FOUND']); */

/*                     header("Location: accueil.php"); */
            }else{
                $_SESSION['USERNAME_FOUND'] = false;
                /* header("Location: accueil.php"); */
            }
            
        }
    } else{
        include_once "NeedConnection.tpl";
        header( "refresh:6; url=connexion.html" );
    }

?>