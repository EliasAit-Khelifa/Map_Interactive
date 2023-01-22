<?php
session_start();

    $adresse = $_POST['adresse'];

    //DataBase Connection
    if(isset($_SESSION['LOGGED_USERNAME'])){
        $email = $_SESSION['LOGGED_EMAIL'];
        $uname = $_SESSION['LOGGED_USERNAME'];
        $conn = new mysqli('localhost', 'root', 'root','test');
        if($conn->connect_error){
            die('Connection Failed : '.$conn->connect_error);
        }else{
            $stmt = $conn->prepare("insert into adresseregister(email,uname,adress)
                values(?, ?, ?)");
            $stmt->bind_param("sss",$email,$uname,$adresse);
            $stmt->execute();
            header("Location: accueil.php");
            $stmt->close();
            $conn->close();
        }
    } else{
        include_once "NeedConnectionAddAdresse.tpl";
        header( "refresh:6; url=connexion.html" );
    }
        

?>