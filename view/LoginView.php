<?php

namespace view;

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private static $register = 'LoginView::Register';



	private const LOGIN_WITH_COOKIES_MESSAGE = 'Welcome back with cookie';
	private const KEPT_LOGGEDIN_MESSAGE = 'Welcome and you will be remembered';
	private const USERNAME_MISSING = 'Username is missing';
	private const PASSWORD_MISSING = 'Password is missing';
	private const FAILED_TO_LOGIN = 'Wrong name or password';
	private const LOGOUT_MESSAGE = 'Bye bye';
	private const LOGIN_MESSAGE = 'Weclome';
	private const EMPTY_STRING = '';

	private $loginModel;
	
	public function __construct(\model\LoginModel $lm)
	{
		$this->loginModel = $lm;
	}
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isSession) {
		$message = $this->getMessages($isSession);
		if ($isSession && !$this->userWantsToLogut()) {
			$response = $this->generateLogoutButtonHTML($message);
		} else {
			$response = $this->generateLoginFormHTML($message);
		}
		return $response;
	}


	public function getMessages($isSession) {
		$messages = self::EMPTY_STRING;
		if ($this->userWantsToLogin()) {
			if($this->getLoggedInStatus() && $this->userWantsToKeepLoggedIn()) {
				$messages .= self::KEPT_LOGGEDIN_MESSAGE;
			}  else if($this->getLoggedInStatus()) {
				$messages .= self::LOGIN_MESSAGE;
			} else if (!$this->getLoggedInStatus()) {
				$messages .= self::FAILED_TO_LOGIN;
			}	else if(!$this->isUsernameValid()) {
				$messages .= self::USERNAME_MISSING;
			} else if (!$this->isPasswordValid()) {
				$messages .= self::PASSWORD_MISSING;
			}
		} else if(!$isSession && $this->userWantsToLogut()){
			$messages .= self::LOGOUT_MESSAGE;
		}	else if ($this->checkIfCookiesExist()) {
			$messages .= self::LOGIN_WITH_COOKIES_MESSAGE;
		}
		else {
			$messages = self::EMPTY_STRING;
		}
		return $messages;
	}

	/**
	 * set messages
	 */
	public function setMessage($message) {
		$this->messages .= $message;
	} 

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	

	/**
	 * check if username exits and are not empty if empty set message
	 */
	public function isUsernameValid() {
		if(isset($_POST[self::$name]) && !empty($_POST[self::$name])) {
			return true;
		}
	}

	/**
	 * check if password exits and are not empty if empty set message
	 */
	public function isPasswordValid() {
		if(isset($_POST[self::$password]) && !empty($_POST[self::$password])) {
			return true;
		} 
	}

	/**
	 * check if username and password are empty or not
	 * 
	 * @return bool
	 */
	private function isUsernameAndPasswordNotEmpty() : bool {
		return !empty($_POST[self::$name]) && !empty($_POST[self::$password]);
	}
	
	/**
	 * return the post in name
	 * 
	 * @return string
	 */
	public function getRequestUserName() {
		return $_POST[self::$name];
	}

	/**
	 * return the post of password
	 * 
	 * @return string
	 */
	public function getRequestPassword() {
			return $_POST[self::$password];
	}


	/**
	 * return true if post on login
	 * 
	 * @return bool
	 */
	public function userWantsToLogin() : bool {
		return isset($_POST[self::$login]);
	}

	/**
	 * return true if post on logout
	 * @return bool
	 */
	public function userWantsToLogut() : bool {
		return isset($_POST[self::$logout]);
	}

	/**
	 * return true 
	 * 
	 * @return bool
	 */
	public function userWantsToKeepLoggedIn() : bool {
		return isset($_POST[self::$keep]);
	}


	/**
	 * check if cookie exits
	 */
	public function checkIfCookiesExist() {
		return isset($_COOKIE[self::$cookieName], $_COOKIE[self::$cookiePassword]);
	}

	/**
	 * set cookie for one day
	 */
	public function setCookies() {
		setcookie(self::$cookieName, $this->getRequestUserName(), time() + (86400), "/"); // 86400 = 1 day
		setcookie(self::$cookiePassword, $this->getRequestPassword(), time() + (86400), "/"); // 86400 = 1 day
	}

	/**
	 * return cookie username
	 */
	public function getCookieName() {
		return $_COOKIE[self::$cookieName];
	}

	/**
	 * return cookie password
	 */
	public function getCookiePassword() {
		return $_COOKIE[self::$cookiePassword];
	}

	/**
	 * removes cookie from browser
	 */
	public function removeCookies() {
		unset($_COOKIE[self::$cookieName]);
		unset($_COOKIE[self::$cookiePassword]);
    setcookie(self::$cookieName, null, -1, '/');
    setcookie(self::$cookiePassword, null, -1, '/');
	}

	public function getLoggedInStatus() {
		return $this->loginModel->getLoggedInStatus();
	}
}