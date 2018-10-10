<?php

namespace model;

class LoginModel {

  // private $loggedInstatus = false;
  
  public function login($name, $password) {
    include('Database.php');
    // echo $name, $password;
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