<?php

namespace model;

require_once('Database.php');

class RegisterModel {

  private $registerStatus = false;

  public function __construct()
  {
    $this->database = new \model\Database();
    $this->connection = $this->database->server();
  }

  /**
   * adds a user to the database
   */
  public function addUserToDatabase($user) {
    $name = $user->getName();
    $password = $user->getHashedPassword();
    $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";
    $insertToDb = $this->connection->prepare($sql);
    $insertToDb->bindParam(':name', $name);
    $insertToDb->bindParam(':password', $password);
    $insertToDb->execute();
    $this->registerStatus = true;
  }

  public function getRegisterStatus() {
    return $this->registerStatus;
  }

}   