<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
$bdd = new PDO('mysql:host=127.0.0.1;dbname=my_shop;port=3306','jules','juju');
$usermail = $_POST["email"];
$userpaswd = $_POST["password"];
$req = ("SELECT password, admin FROM users WHERE email = '$usermail'"); 
$usercheck = $bdd->query($req);
$usercheck2 = $usercheck->fetchAll(PDO::FETCH_ASSOC);
$admcheck = $usercheck2[0]['admin'];
    /*if (!$usercheck2["password"]){
        echo "Utilisateur inexistant. Créez un compte.";
    }
    else {*/
        if (password_verify($userpaswd, $usercheck2[0]['password']) && $admcheck == '1'){
        session_start();
        echo "connecté";
        header('Location: http://localhost/my_shop/index_admin.php');
        }
        
        else if (password_verify($userpaswd, $usercheck2[0]['password'])){
            session_start();
            echo "connecté";
            header('Location: http://localhost/my_shop/redirlogin.html');
            }
        
        else {
            echo "email ou mot de passe incorrect";
        }
    

        











