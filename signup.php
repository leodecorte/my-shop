<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include_once("user.php");
$connexion = new PDO('mysql:host=127.0.0.1;dbname=my_shop;port=3306','jules','juju');

$reqcheck = ("SELECT email FROM users WHERE email = '$_POST[email]'");
$checkexist = $connexion->query($reqcheck);
$checkexist2 = $checkexist->fetchAll(PDO::FETCH_ASSOC);
if ($checkexist2[0]["email"] == ($_POST['email'])){
    echo "Utilisateur déjà inscrit";
    return;
}
else {
    $user = new User; 
    $req = ("INSERT INTO users(email, password) VALUES ('$user->usermail', '$user->hash')"); 
    $register = $connexion->query($req); 
        if ($register = true){
        echo "Votre compte a été créé. Vous pouvez désormais vous connecter.";
        header('Location: http://localhost/my_shop/redirsignup.html');
        }

        else {
        throw new Exception("Erreur, veuillez réessayer");
        }
    }
?>