<?php

namespace controller;

require_once('login/model/User.php');

class LoginController {

  private $loginView;
  private $loginModel;
  private $layoutView;
  private $sessionModel;

  public function __construct(
    \view\LoginView $v,
    \model\LoginModel $lm,
    \view\layoutView $lv,
    \model\SessionModel $sm
  )
  {
    $this->loginView = $v;
    $this->loginModel = $lm;
    $this->layoutView = $lv;
    $this->sessionModel = $sm;
  }


  /**
   * logs in user and set session
   */
  public function routeToLogin() {
    if($this->loginView->usernameExists() && $this->loginView->passwordExists()) {
      $user = new \model\User($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword());
      $this->loginModel->login($user);
      // var_dump($this->loginModel->getLoggedInStatus());
      if($this->loginModel->getLoggedInStatus()) {
        $this->sessionModel->setSession($this->loginView->getRequestUserName());
      }
    }
  }
  
  /**
   * log in user with cookie and set session
   */
  public function routeToLoginWithCookie() {
    $user = new \model\User($this->loginView->getCookieName(), $this->loginView->getCookiePassword());
    $this->loginModel->login($user); 
    if($this->loginModel->getLoggedInStatus()) {
      $this->sessionModel->setSession($this->loginView->getCookieName());
    }
  }
  
  /**
   * logs out user
   */
  public function routeToLogout() {
    $this->loginView->removeCookies();
    $this->sessionModel->endLoginSession();
  }

}