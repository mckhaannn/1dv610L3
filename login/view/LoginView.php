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
	private static $wall = 'LoginView::Wall';

	private const LOGIN_WITH_COOKIES_MESSAGE = 'Welcome back with cookie';
	private const KEPT_LOGGEDIN_MESSAGE = 'Welcome and you will be remembered';
	private const USERNAME_MISSING = 'Username is missing';
	private const PASSWORD_MISSING = 'Password is missing';
	private const FAILED_TO_LOGIN = 'Wrong name or password';
	private const LOGOUT_MESSAGE = 'Bye bye!';
	private const LOGIN_MESSAGE = 'Welcome';
	private const EMPTY_STRING = '';

	private $loginModel;
	
	public function __construct(\model\LoginModel $lm)
	{
		$this->loginModel = $lm;
	}

	/**
	 * render login view
	 */
	public function loginResponse() {
		$message = $this->getLoginMessages();
		$response = $this->generateLoginFormHTML($message);
		return $response;
	}

	/**
	 * logout form
	 */
	public function loggedInResponse($isSession) {
		$message = $this->getLoggedInMessages($isSession);
		$response =  $this->generateLogoutButtonHTML($message);
		return $response;
	}


	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
				<input type="submit" name="' . self::$wall . '" value="wall"/>
			</form>
		';
	}
	
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->saveUsername() . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	private function getLoggedInMessages($isLoggedInSession) {
		if(!$isLoggedInSession && $this->userWantsToLogut()){
			$messages .= self::LOGOUT_MESSAGE;
		}	else if ($this->checkIfCookiesExist()) {
			$messages .= self::LOGIN_WITH_COOKIES_MESSAGE;
		} else if($isLoggedInSession) {
			$messages .= self::LOGIN_MESSAGE;
		} else {
			$messages = self::EMPTY_STRING;
		}
		return $messages;
	}

	private function getLoginMessages() {
		$messages = self::EMPTY_STRING;
		if ($this->userWantsToLogin()) {
			if($this->getLoggedInStatus() && $this->userWantsToKeepLoggedIn()) {
				$messages .= self::KEPT_LOGGEDIN_MESSAGE;
			}	else if(!$this->usernameExists()) {
				$messages .= self::USERNAME_MISSING;
			} else if (!$this->passwordExists()) {
				$messages .= self::PASSWORD_MISSING;
			} else if (!$this->getLoggedInStatus()) {
				$messages .= self::FAILED_TO_LOGIN;
			}
		
		return $messages;
		}
	}

	public function usernameExists() {
		if(isset($_POST[self::$name]) && !empty($_POST[self::$name])) {
			return true;
		}
	}

	public function passwordExists() {
		if(isset($_POST[self::$password]) && !empty($_POST[self::$password])) {
			return true;
		} 
	}
	
	private function isUsernameAndPasswordNotEmpty() : bool {
		return !empty($_POST[self::$name]) && !empty($_POST[self::$password]);
	}

	private function saveUsername() {
		return $this->getRequestUserName();
	}
	
	public function userWantsToLogin() : bool {
		return isset($_POST[self::$login]);
	}
	
	public function userWantsToLogut() : bool {
		return isset($_POST[self::$logout]);
	}
	
	public function userWantsToKeepLoggedIn() : bool {
		return isset($_POST[self::$keep]);
	}
	public function goToPostWall() : bool {
		return isset($_POST[self::$wall]);
	}
	
	public function checkIfCookiesExist() {
		return isset($_COOKIE[self::$cookieName], $_COOKIE[self::$cookiePassword]);
	}

  
	public function getCookieName() {
		return $_COOKIE[self::$cookieName];
	}
	
	public function getCookiePassword() {
		return $_COOKIE[self::$cookiePassword];
	}
	
	public function getLoggedInStatus() {
		return $this->loginModel->getLoggedInStatus();
	}

	public function getRequestUserName() {
		if(isset($_POST[self::$name])) {
			return $_POST[self::$name];
		}
	}

	public function getRequestPassword() {
		if($_POST[self::$password]) {
			return $_POST[self::$password];
		}
	}
	
	/**
	 * set cookie for one day
	 */
	public function setCookies() {
		setcookie(self::$cookieName, $this->getRequestUserName(), time() + (86400), "/"); // 86400 = 1 day
		setcookie(self::$cookiePassword, $this->getRequestPassword(), time() + (86400), "/"); // 86400 = 1 day
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
}