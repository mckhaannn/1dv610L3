<?php

namespace model;

class RegisterModel {

  private $registerStatus = false;
  
  public function addUserToDatabase($user) {
    include('Database.php');
    $name = $user->getName();
    // var_dump($name);
    $password = $user->getHashedPassword();
    $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";
    $insertToDb = $connection->prepare($sql);
    $insertToDb->bindParam(':name', $name);
    $insertToDb->bindParam(':password', $password);
    $insertToDb->execute();
    $this->registerStatus = true;
  }
}