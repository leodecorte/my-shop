<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
$connexion = new PDO('mysql:host=127.0.0.1;dbname=my_shop;port=3306','jules','juju');
class Product{
public $name = null;
public $price = null;
public $description = null;
public $type = null;
public $model = null;
    
    public function __construct(){
        $this->name = ($_POST["nameproduct"]);
        $this->price = ($_POST["priceproduct"]);
        $this->description = ($_POST["descproduct"]);
        $this->type = ($_POST["typeproduct"]);
    }

    public function searchProduct() {
        $res = array();
        $cmd = $connexion>query("SELECT * FROM products ORDER BY name desc");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }


}