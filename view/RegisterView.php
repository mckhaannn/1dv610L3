<?php

namespace view;

class RegisterView {

  private const USERNAME_TO_SHORT_MESSAGE = 'Username has too few characters, at least 3 characters.';
  private const PASSWORD_TO_SHORT_MESSAGE = 'Password has too few characters, at least 6 characters.';
  private const USERNAME_CONTAINS_INVALID_CHARACTERS = 'Username contains invalid characters.';
  private const PASSWORDS_NOT_EQUAL = 'Passwords do not match.';
  private const EMPTY_STRING = '';

  private const MIN_PASSWORD_LENGTH = 6;
  private const MIN_USERNAME_LENGTH = 3;
  
  private static $register = 'RegisterView::Register';
  private static $messageId = 'RegisterView::Message';
	private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
  private static $passwordRepeate = 'RegisterView::PasswordRepeat';
  private $messages = self::EMPTY_STRING;

  public function response() {
    $response = $this->generateRegisterForm($this->messages);
    return $response;
  }

  public function getMessages() {
    if() {
      
    }
  }

  public function generateRegisterForm($message) {
    return '
    <form action="?register" method="post" > 
      <fieldset>
        <legend>Register a new user - Write username and password</legend>
        <p id="' . self::$messageId . '">' . $message . '</p>
        <label for="' . self::$name . '">Username :</label>
        <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />
        
        <label for="' . self::$password . '">Password :</label>
        <input type="password" id="' . self::$password . '" name="' . self::$password . '" />
        
        <label for="' . self::$passwordRepeate . '">Repeate Password :</label>
        <input type="password" id="' . self::$passwordRepeate . '" name="' . self::$passwordRepeate . '" />
        
        <input type="submit" name="' . self::$register . '" value="Register" />
        </fieldset>
        </form>
        ';
      }
      

    /**
     * set messages
     */
    public function setMessage($message) {
      $this->messages .= $message;
    }
    
    public function getRequestRegisterUsername() {
      return $_POST[self::$name];
    }
    public function getRequestRegisterPassword() {
      return $_POST[self::$password];
    }
    
    public function userWantsToRegister() : bool {
      return isset($_POST[self::$register]);
    }
    
    /**
     * check if password has valid lenght
     */
    public function checkValidPasswordLenght() : bool {
      if(strlen($this->getRequestRegisterPassword()) >= self::MIN_PASSWORD_LENGTH) {
        return true;
      } else {
        throw new \Exception(self::USERNAME_TO_SHORT_MESSAGE);
      }
    }
    
    /**
     * check if username has lenght is valid
     */
    public function checkValidUsernameLenght() {
      if(strlen($this->getRequestRegisterUsername()) >= self::MIN_USERNAME_LENGTH) {
        return true;
      } else {
        throw new \Exception(self::PASSWORD_TO_SHORT_MESSAGE);
      }
    }
    
    /**
   * check if passwords are equal
   * @return 
   */
  public function isPasswordEqual() {
    if($_POST[self::$password] == $_POST[self::$passwordRepeate]) {
      return true;
    } else {
      throw new \Exception(self::PASSWORDS_NOT_EQUAL);
    }
  }
    
    /**
     * check if the username contains tags
     */
    public function usernameContainsValidCharacters() {
      if($this->getRequestRegisterUsername() == strip_tags($this->getRequestRegisterUsername())) {
        return true;
      } else {
        throw new \Exception(self::USERNAME_CONTAINS_INVALID_CHARACTERS);
      }
    }



      // 	/** 
	// * Validates the username
	// * 
	// * @return bool
	// */
	// public function validateUsername() : bool {
  //   if(isset($_POST[self::$password]) && empty($_POST[self::$password])) {
	// 		$this->setMessage('Password is missing');
	// 	} else {
	//     return isset($_POST[self::$name]) && !empty($_POST[self::$name]);
  //   }
  // }
  // /**
  //  * validate password
  //  * @return bool
  //  */
  // public function validatePassword() : bool {
  //   if(isset($_POST[self::$password]) && empty($_POST[self::$password])) {
  //     $this->setMessage('Password is missing');
  //   } else {
  //     return isset($_POST[self::$password]) && !empty($_POST[self::$password]);
  //   }
  // }



}