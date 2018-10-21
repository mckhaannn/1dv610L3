<?php

namespace model;

class LoginModel {
  
  private $loggedInStatus = false;

  public function login($user) {
    include('Database.php');
    $name = $user->getName();
    $password = $user->getPassword();
    $match = $connection->prepare("SELECT * FROM users WHERE name=:name");
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