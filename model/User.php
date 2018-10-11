<?php 

namespace model;

class User{

  private const USERNAME_TO_SHORT = 'Username has too few characters, at least 3 characters.';
  private const PASSWORD_TO_SHORT = 'Password has too few characters, at least 6 characters.';
  private const CONTAINS_INVALID_CHARACTERS = 'Username contains invalid characters.';
  
  private const MIN_PASSWORD_LENGTH = 5;
  private const MIN_USERNAME_LENGTH = 2;
  
  private $name;
  private $password;
  
  public function __construct($name, $password)
  {
    $this->name = $name;
    $this->password = $password;
  }
  
  /**
   * removes tags in username
   */
  public function removeTags() {
    return strip_tags($this->name);
  }
  
  /**
   * return name of user
   */
  public function getName() {
    return $this->name;
  }
  
  /**
   * return password of user
   */
  public function getPassword() {
    return $this->password;
  }
  
  /**
   * return hashed password
   */
  public function getHashedPassword() {
    return password_hash($this->password, PASSWORD_DEFAULT);
  }
  
  /**
   * check if password has valid lenght
   */
  public function checkValidPasswordLenght() : bool {
    if(strlen($this->password) > MIN_USERNAME_LENGTH) {
      return true;
    } else {
      throw new \Exception(USERNAME_TO_SHORT);
    }
  }
  
  /**
   * check if username has lenght is valid
   */
  public function checkValidUsernameLenght() : bool {
    if(strlen($this->password) > MIN_PASSWORD_LENGTH) {
      return true;
    } else {
      throw new \Exception(PASSWORD_TO_SHORT);
    }
  }
  

  /**
   * check if the username contains tags
   */
  public function stripTagsFromUsername() : bool {
    if($this->name != strip_tags($this->name)) {
      throw new \Exception(CONTAINS_INVALID_CHARACTERS);
    } else {
      return true;
    }
  }


}