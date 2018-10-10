<?php

namespace model;

class LoginModel {

  
  public function login($name, $password) {
    include('db.php');
    $match = $connection->prepare("SELECT * FROM users WHERE name=:name LIMIT 1");
    $match->bindParam(':name', $name);
    $match->execute();
    $results = $match->fetch();
    if($results && password_verify($password, $results['password'])) {
      return true;
    } else {
      return false;
    }
  }
}