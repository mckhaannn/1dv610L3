<?php

namespace model;

require_once('Database.php');

class UserCredentials {

  private const MIN_USERNAME_LENGTH = 2;
  private const MIN_PASSWORD_LENGTH = 5;

  private $user;

  public function __construct()
  {
    $this->database = new \model\Database();
    $this->connection = $this->database->server();
  }

  public function setUser($user)
  {
    $this->user = $user;
  }

  public function isUsernameContainingValidCharacters() {
    return $this->user->getName() == $this->user->stripTagsFromUsername();
  }

  public function checkValidPasswordLength() : bool {
    return strlen($this->user->getPassword()) > self::MIN_PASSWORD_LENGTH;
  }
  
  public function checkValidUsernameLenght() {
    return strlen($this->user->getName()) > self::MIN_USERNAME_LENGTH; 
  }
  
  public function doesUsernameExist() {
    $name = $this->user->getName();
    $result = $this->connection->prepare("SELECT * FROM users WHERE name=:name");
    $result->bindParam(':name', $name);
    $result->execute();
    $matches = $result->fetchColumn(); 
    if($matches) {    
      return false;
    } else {
      return true;
    }
  }


  public function validCredentials() {
    return
      $this->checkValidUsernameLenght() &&
      $this->checkValidPasswordLength() && 
      $this->isUsernameContainingValidCharacters() &&
      $this->doesUsernameExist();
  }
}