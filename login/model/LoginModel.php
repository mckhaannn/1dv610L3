<?php

namespace model;

require_once('Database.php');

class LoginModel {

  
  private $loggedInStatus = false;

  public function __construct()
  {
    $this->database = new \model\Database();
    $this->connection = $this->database->server();
  }

  public function login($user) {
    $name = $user->getName();
    $password = $user->getPassword();
    $match = $this->connection->prepare("SELECT * FROM users WHERE name=:name LIMIT 1");
    $match->bindParam(':name', $name);
    $match->execute();
    $results = $match->fetch();
    if($results && password_verify($password, $results['password'])) {
      $this->loggedInStatus = true;
    }
  }

  public function getLoggedInStatus() {
    return $this->loggedInStatus;
  }
}