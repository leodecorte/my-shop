<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
$connexion = new PDO('mysql:host=127.0.0.1;dbname=my_shop;port=3306','jules','juju');
$folder = "/Applications/XAMPP/xamppfiles/htdocs/my_shop/upload/";
$file = basename($_FILES["img"]["name"]);
$filetype = pathinfo($file);
$idupload = $_POST["idimg"];
$imgpath = "/Applications/XAMPP/xamppfiles/htdocs/my_shop/upload/$file";
$req2 = "UPDATE products SET img_source = '$imgpath' WHERE ID='$idupload'";

     if(move_uploaded_file($_FILES["img"]["tmp_name"], $folder . $file) && ($filetype["extension"]=="jpg") && isset($file) && isset($idupload))
     {
          echo 'Upload effectué avec succès !';
          $connexion->query($req2);
          header('location: index_admin.php');
     }
     else 
     {
          echo 'Echec de l\'upload !';
     }

?>