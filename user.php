<?php

class User{
public $usermail;
public $paswd;
public $hash;
   public function __construct()
   {  
    $this->usermail = ($_POST["email"]);
   /*return le mail dans db*/
    $this->paswd = ($_POST["password"]);
    /*return le paswd dans db*/
    $this->hash = password_hash($this->paswd, PASSWORD_BCRYPT);
   }


   public function searchUsers() {

      $res = array();

      $cmd = $this->pdo->query("SELECT * FROM users ORDER BY id desc");

      $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $res;
   }
};

?>