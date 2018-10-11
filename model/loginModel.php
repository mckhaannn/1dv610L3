<?php

namespace model;

class LoginModel {
  
  public function login($user) {
    include('Database.php');
    // echo $name, $password;
    var_dump($user);
    $match = $connection->prepare("SELECT * FROM users WHERE name=:name");
    $match->bindParam(':name', $user->getName());
    $match->execute();
    $results = $match->fetch();
    if($results && password_verify($user->getPassword(), $results['password'])) {
      return true;
    } else {
      return false;
    }
  }
}