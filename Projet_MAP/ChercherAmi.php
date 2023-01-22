<?php
    session_start();

    $_SESSION['USERNAME_FOUND'] = false;
    $_SESSION['USERNAME_NOTFOUND'] = true;

    if(isset($_SESSION['LOGGED_USERNAME'])){
        $user = $_SESSION['LOGGED_USERNAME'];
        $usernameAmi = $_POST['ami'];

        $con = new mysqli('localhost', 'root', 'root','test');
        if($con->connect_error){
            die("Connection Failed : ".$con->connect_error);
        }else{
            $stmt = $con->prepare("select * from registration where uname = ?");
            $stmt->bind_param("s",$usernameAmi);
            $stmt->execute();
            $stmt_result= $stmt->get_result();
            if($stmt_result->num_rows > 0){
                $data = $stmt_result->fetch_assoc();
                if($data['uname'] === $usernameAmi){
                    $_SESSION['USERNAME_FOUND'] = true;
                    $_SESSION['USERNAME_AMI'] = $usernameAmi;
                    header("Location: accueil.php");
                }else{
                    $_SESSION['USERNAME_FOUND'] = false;
                    $_SESSION['USERNAME_AMI'] = $usernameAmi;
                    header("Location: accueil.php");
                }
            }else{
                $_SESSION['USERNAME_FOUND'] = false;
                $_SESSION['USERNAME_AMI'] = $usernameAmi;
                header("Location: accueil.php");
            }
            
        }
    } else{
        include_once "NeedConnection.tpl";
        header( "refresh:6; url=connexion.html" );
    }

?>