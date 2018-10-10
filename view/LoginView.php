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


	private $message = '';
	

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isLoggedIn) {
		$message = '';
		if($isLoggedIn) {
			$this->setMessage('Welcome');
			$response = $this->generateLogoutButtonHTML($this->message);
		} else if ($this->checkIfCookiesExist()) {
			$this->setMessage('Welcome back with cookies.');
			$response = $this->generateLogoutButtonHTML($this->message);
		} else {
			$response = $this->generateLoginFormHTML($this->message);
		}
		return $response;
	}

	public function setMessage($message) {
		$this->message .= $message;
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
	 * return the post in name
	 * 
	 * @return string
	 */
	public function getRequestUserName() {
		if(empty($_POST[self::$name])) {
			$this->setMessage("Usernae is missing ");
		} else {
			return $_POST[self::$name];
		}
	}

	public function checkIfCredentialsIsValid() {
		
	}

	/**
	 * return the post of password
	 * 
	 * @return string
	 */
	public function getRequestPassword() {
		if(empty($_POST[self::$password])) {
			$this->setMessage('Password is missing');
		} else {
			return $_POST[self::$password];
		}
	}

	/**
	 * return true if click on register
	 * 
	 * @return bool
	 */
	public function userWantsToRegister() : bool {
		return isset($_GET[self::$register]);
	}

	/**
	 * return true if post on login
	 * 
	 * @return bool
	 */
	public function userWantsToLogin() : bool {
		return isset($_POST[self::$login]);
	}

	public function userWantsToLogut() : bool {
		return isset($_POST[self::$logout]);
	}

	/**
	 * return true uf
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

}