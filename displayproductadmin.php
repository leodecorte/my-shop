<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once("productclass.php");
$connexion = new PDO('mysql:host=127.0.0.1;dbname=my_shop;port=3306','jules','juju');
$id = $_POST["iddelete"];
$req = ("DELETE FROM products WHERE ID = '$id'");
$delproduct = $connexion->query($req);
if ($delproduct = true){
    header('Location: http://localhost/my_shop/upload/maison.jpg');}

?>

