<?php

namespace model;

class RegisterModel {

  private $registerStatus = false;
  
  public function addUserToDatabase($user) {
    include('Database.php');
    $name = $user->getName();
    $password = $user->getHashedPassword();
    $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";
    $insertToDb = $connection->prepare($sql);
    $insertToDb->bindParam(':name', $name);
    $insertToDb->bindParam(':password', $password);
    $insertToDb->execute();
    return false;
  }

  public function usernameAlreadyExists() {
    include('db.php');
    $result = $connection->prepare("SELECT * FROM users WHERE name=:name");
    $result->bindParam(':name', $this->username);
    $result->execute();
    $matches = $result->fetchColumn(); 
    if($matches) {    
      return false;
    } else {
      return true;
    }
  }
  public function getRegisterStatus() {
    return $this->registerStatus;
  }
}   