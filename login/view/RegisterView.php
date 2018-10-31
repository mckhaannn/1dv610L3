<?php

namespace view;

require_once('login/view/Messages.php');

class RegisterView {

  private static $register = 'RegisterView::Register';
  private static $messageId = 'RegisterView::Message';
	private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
  private static $passwordRepeate = 'RegisterView::PasswordRepeat';

  private $userCredentials;
  private $message = \view\Messages::EMPTY_STRING;

  public function __construct(\model\UserCredentials $uc)
  {
    $this->userCredentials = $uc;
  }

  public function response() {
    $message = $this->getMessages();
    $response = $this->generateRegisterForm($message);
    return $response;
  }
  
  public function generateRegisterForm($message) {
    return '
    <form action="?register" method="post" > 
      <fieldset>
        <legend>Register a new user - Write username and password</legend>
        <p id="' . self::$messageId . '">' . $message . '</p>
        <label for="' . self::$name . '">Username :</label>
        <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->saveUsername() . '" />
        
        <label for="' . self::$password . '">Password :</label>
        <input type="password" id="' . self::$password . '" name="' . self::$password . '" />
        
        <label for="' . self::$passwordRepeate . '">Repeate Password :</label>
        <input type="password" id="' . self::$passwordRepeate . '" name="' . self::$passwordRepeate . '" />
        
        <input type="submit" name="' . self::$register . '" value="Register" />
      </fieldset>
    </form>';
  }
   
  public function getMessages() {
    $messages = \view\Messages::EMPTY_STRING;
    if($this->userWantsToRegister()) {
      if(!$this->isPasswordEqual()) {
        $messages .= \view\Messages::PASSWORDS_NOT_EQUAL . \view\Messages::BREAK_ROW;
      }
      if(!$this->userCredentials->isUsernameContainingValidCharacters()) {
        $messages .= \view\Messages::USERNAME_CONTAINS_INVALID_CHARACTERS . \view\Messages::BREAK_ROW;
      }
      if(!$this->userCredentials->checkValidUsernameLenght()) {
        $messages .= \view\Messages::USERNAME_TO_SHORT_MESSAGE . \view\Messages::BREAK_ROW;
      }
      if(!$this->userCredentials->checkValidPasswordLength()) {
        $messages .= \view\Messages::PASSWORD_TO_SHORT_MESSAGE . \view\Messages::BREAK_ROW;
      }
      if(!$this->userCredentials->doesUsernameExist()) {
        $messages .= \view\Messages::USERNAME_EXISTS . \view\Messages::BREAK_ROW;
      }
    } else {
       $messages = \view\Messages::EMPTY_STRING;
      }
    return $messages;
  } 

  private function saveUsername() {
    return strip_tags($this->getRequestRegisterUsername());
  }
  
  /**
   * check if passwords are equal
   * @return 
   */
  public function isPasswordEqual() {
    return $_POST[self::$password] == $_POST[self::$passwordRepeate];
    
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
    
}