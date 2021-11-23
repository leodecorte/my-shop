<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');



class Stock{

function displayStock(){
$connexion = new PDO('mysql:host=127.0.0.1;dbname=my_shop;port=3306','jules','juju');
$res = array();
        $cmd = $connexion->query("SELECT * FROM products ORDER BY name desc");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

public function deleteProduct($id) {

    $cmd = $this->pdo->prepare("DELETE FROM products WHERE ID = :id");
    $cmd->bindValue(":id", $id);
    $cmd->execute();
    }
}


?>
