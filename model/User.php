<?php 

namespace model;

class User{

  private $name;
  private $password;
  
  public function __construct($name, $password)
  {
    $this->name = $name;
    $this->password = $password;
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
    return password_hash($this->getPassword(), PASSWORD_DEFAULT);
  }
  
  /**
   * removes tags in username
   */
  public function stripTagsFromUsername() {
    return strip_tags($this->name);
  }
  
  




}