<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once("user.php");
$connexion = new PDO('mysql:host=127.0.0.1;dbname=my_shop;port=3306','jules','juju');
/* $reqpass = "UPDATE users SET password = '$_POST[passedit]' where ID = '$_POST[idedit]'";
$reqadm = "UPDATE users SET admin = '$_POST[admedit]' where ID = '$_POST[idedit]'"; */

if (isset($_POST['emailedit'])){
    $reqmail = ("UPDATE users SET email = '$_POST[emailedit]' where ID = '$_POST[idedit]'");
    $connexion->query($reqmail);
    $connexiont->fetch();
}



?>