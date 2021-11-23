<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once("productclass.php");

$connexion = new PDO('mysql:host=127.0.0.1;dbname=my_shop;port=3306','jules','juju');
$product = new Product;
$req = ("INSERT INTO products(name, price, description, type) VALUES ('$product->name', '$product->price', '$product->description', '$product->type')");
$addproduct = $connexion->query($req);
    if (($addproduct = true) && (!empty($product->name && $product->price && $product->description && $product->type))) {
        echo "Nouveau produit ajouté !";
        header('Location: http://localhost/my_shop/index_admin.php');
        return;
    }
    if (($addproduct = true) && (empty($product->name || $product->price || $product->description || $product->type))) {
        echo "Il manque une information";
        return;
    }
    else {
        echo "Erreur dans l'ajout du nouveau produit.";
    }






