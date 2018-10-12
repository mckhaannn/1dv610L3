<?php

namespace view;

class RegisterView {

  private static $register = 'RegisterView::Register';
  private static $messageId = 'RegisterView::Message';
	private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
  private static $passwordRepeate = 'RegisterView::PasswordRepeat';

  private const USERNAME_TO_SHORT_MESSAGE = 'Username has too few characters, at least 3 characters.';
  private const PASSWORD_TO_SHORT_MESSAGE = 'Password has too few characters, at least 6 characters.';
  private const USERNAME_CONTAINS_INVALID_CHARACTERS = 'Username contains invalid characters.';
  private const PASSWORDS_NOT_EQUAL = 'Passwords do not match.';
  private const BREAK_ROW = '<br>';
  private const EMPTY_STRING = '';

  private const MIN_USERNAME_LENGTH = 2;
  private const MIN_PASSWORD_LENGTH = 5;
  
  private $message = self::EMPTY_STRING;
  
  public function response() {
    $message = $this->getMessages();
    $response = $this->generateRegisterForm($message);
    return $response;
  }
  
  public function getMessages() {
    $messages = self::EMPTY_STRING;
    if($this->userWantsToRegister()) {
      if(!$this->isPasswordEqual()) {
        $messages .= self::PASSWORDS_NOT_EQUAL . self::BREAK_ROW;
      }
      if(!$this->usernameContainsValidCharacters()) {
        $messages .= self::USERNAME_CONTAINS_INVALID_CHARACTERS . self::BREAK_ROW;
      }
      if(!$this->checkValidUsernameLenght()) {
        $messages .= self::USERNAME_TO_SHORT_MESSAGE . self::BREAK_ROW;
      }
      if(!$this->checkValidPasswordLenght()) {
        $messages .= self::PASSWORD_TO_SHORT_MESSAGE . self::BREAK_ROW;
      } else {
        $messages = self::EMPTY_STRING;
      }
    }
    return $messages;
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
      if(isset($_POST[self::$name])) {
        return $_POST[self::$name];
      }
    }
    public function getRequestRegisterPassword() {
      if(isset($_POST[self::$password])) {
        return $_POST[self::$password];
      }
    }
    
    public function userWantsToRegister() : bool {
      return isset($_POST[self::$register]);
    }
    
    /**
     * check if password has valid lenght
     */
    public function checkValidPasswordLenght() : bool {
      return strlen($_POST[self::$name]) > self::MIN_PASSWORD_LENGTH;
    }
    
    /**
     * check if username has lenght is valid
     */
    public function checkValidUsernameLenght() {
      // var_dump(strlen($_POST[self::$name])>= self::MIN_USERNAME_LENGTH);
     return strlen($_POST[self::$name]) > self::MIN_USERNAME_LENGTH; 
    }
    
    /**
   * check if passwords are equal
   * @return 
   */
  public function isPasswordEqual() {
    return $_POST[self::$password] == $_POST[self::$passwordRepeate];
    
  }
    
    /**
     * check if the username contains tags
     */
    public function usernameContainsValidCharacters() {
     return $this->getRequestRegisterUsername() == strip_tags($this->getRequestRegisterUsername());
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