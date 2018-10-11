<?php 

namespace model;

class User{

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
   * check if password has valid lenght
   */
	public function checkValidPasswordLenght() : bool {
		return strlen($this->password) > MIN_PASSWORD_LENGTH;
  }
  
  /**
   * check if username has lenght is valid
   */
	public function checkValidUsernameLenght() : bool {
		return strlen($this->password) > MIN_USERNAME_LENGTH;
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
   * removes tags in username
   */
  public function removeTags() {
    return strip_tags($this->name);
  }

  /**
   * check if the username contains tags
   */
  public function stripTagsFromUsername() : bool {
    if($this->name != strip_tags($this->name)) {
      throw new \Exception('Username contains invalid characters.');
    } else {
      return true;
    }
  }


}