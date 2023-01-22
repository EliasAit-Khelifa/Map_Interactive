<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    <?php include 'css/style.css'; ?>
    </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
        crossorigin=""></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="js/PrefectureFrance.js"></script>
    <script src="js/GareFrance.js"></script>
    <script src="js/accueil_JS.js"></script>

    <title>Document</title>
</head>
<body>
    <h3>
    <?php
    if (isset($_SESSION['LOGGED_USERNAME'])){
        $connecte = "Heureux de vous revoir ". $_SESSION['LOGGED_USERNAME'] . " !";
        echo $connecte;
    }else{
        echo "Connectez vous via le bouton de Login ! :)";
    }
     ?>
    </h3>
    <button id="Login26" onclick="window.location.href='Connexion.html';" style="width:auto;">Login</button>
    <button id="voirAmis" onclick="window.location.href='VoirAmis.php';" style="width:auto;">Voir mes amis</button>
    
    <?php 
    if (isset($_SESSION['LOGGED_USERNAME'])){
        include('logout.tpl');
    }
    ?>
    <?php   
        if(isset($_SESSION['LOGGED_USERNAME'])){
            if($_SESSION['USERNAME_FOUND'] == true){
                include_once "amiTrouver.html";
            }else{
                include_once "amiNonTrouver.html";
            }
        }
    ?>
    <div class="wrapper">
        <div class="contact">
            <h1>Paramètres de la carte</h1>
            <div class="items">
                <div class="item">
                    <form id="villeForm" action="AddAdresse.php" method="POST">
                        <label for="ville">Recherchez une adresse et ajoutez la : </label>
                    <input id="addr" placeholder="Saisissez une ville" name="adresse" value="">
                    <div class="boutonItem1">
                        <button id="boutonSearch" type="button">Chercher</button>
                    </div>
                    <div id="pNew">
                        <p id="p1"></p>
                        <button id="Chercher" type="submit">Ajouter a ma liste d'adresse</button>
                    </div>
                    </form>
                </div>
                <div id="results"></div>
                <div class="item">
                    <form>
                        <label for="prefecture2">Rechercher une prefecture française :</label>
                        <input id="prefecture2" type="text" placeholder="Saisissez une prefecture" name="prefecture2" value="">
                        <div class="boutonItem2">
                            <button id="boutonSearch" type="button">Chercher</button>
                        </div>
                    </form>
                </div>
                <div class="item">
                    <form action="ChercherAmi.php" method="POST">
                        <label for="amis">Rechercher et ajouter un ami !</label>
                        <input id="ami" type="text" placeholder="Nom d'utilisateur" name="ami" value="">
                        <button id="boutonSearch" type="submit">Chercher un utilisateur</button>
                        <p id="pUtilisateur"><?php
                            if(isset($_SESSION['LOGGED_USERNAME'])){
                                if($_SESSION['USERNAME_FOUND'] == true){
                                    echo $_SESSION['USERNAME_AMI'] . " a été trouvé ! Vous pouvez donc l'ajouter via le bouton bleu !";
                                }else{
                                echo $_SESSION['USERNAME_AMI'] . " est introuvable. Veuillez rééssayez";
                                }
                            }
                        ?></p>
                    </form>
                </div>
                <div class="itemsCheck">
                    <div class="item">
                        <div class="itemCheckbox">
                            <label for="adresse">Afficher mes adresses enregistrées : </label>
                            <input id="checkboxAdresse" type="checkbox" name="adresse" value="AfficherAdresse">
                        </div>
                    </div>
                    <div class="item">
                        <div class="itemCheckbox">
                            <label for="prefecture">Afficher les prefectures : </label>
                            <input id="checkboxPrefecture" type="checkbox" name="prefecture" value="AfficherPrefecture">
                        </div>
                    </div>
                    <div class="item">
                        <div class="itemCheckbox">
                            <label for="velib">Afficher les stations de velib : </label>
                            <input id="checkboxVelib" type="checkbox" name="velib" value="AfficherVelib">
                        </div>
                        
                    </div>
                    <div class="item">
                        <div class="itemCheckbox">
                            <label for="gares">Afficher les 800 premières gares : </label>
                            <input id="checkboxGares" type="checkbox" name="gares" value="AfficherGares">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="map"></div>
    </div>
    <div class=AmisDiv>
        
    </div>
</body>
</html>