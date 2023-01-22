<?php
    session_start();

    if(isset($_SESSION['LOGGED_USERNAME'])){
        $user = $_SESSION['LOGGED_USERNAME'];
        $usernameAmi = $_SESSION['USERNAME_AMI'];
    } else{
        echo "Impossible ! Vous devez vous connecter !";
    }


    $conn = new mysqli('localhost', 'root', 'root','test');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into amis(unameAmi,monNom)
            values(?, ?)");
        $stmt->bind_param("ss",$usernameAmi,$user);
        $stmt->execute();

        $stmt->close();
        $conn->close();
        header('Location: accueil.php');
    }

?>