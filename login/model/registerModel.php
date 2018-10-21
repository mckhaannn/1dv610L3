<?php

namespace model;

class RegisterModel {

  private $registerStatus = false;
  

  /**
   * adds a user to the database
   */
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

  public function getRegisterStatus() {
    return $this->registerStatus;
  }
}   