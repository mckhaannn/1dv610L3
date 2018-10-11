<?php

namespace view;

class RegisterView {

  private static $register = 'RegisterView::Register';
  private static $messageId = 'RegisterView::Message';
	private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $passwordRepeate = 'RegisterView::PasswordRepeat';

  public function response() {
    $message = '';
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
     * check if passwords are equal
     * @return 
     */
    public function isPasswordEqual() : bool {
      return $_POST[self::$password] == $_POST[self::$passwordRepeate];
    }
    
    public function getRequestRegisterUsername() {
      return $_POST[self::$name];
    }
    public function getRequestRegisterPassword() {
      return $_POST[self::$password];
    }
    public function getRequestRegisterRepeatPassword() {
      return $_POST[self::$passwordRepeate];
    }
    
    /**
     * set messages
     */
    public function setMessage($message) {
      $this->messages .= $message;
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