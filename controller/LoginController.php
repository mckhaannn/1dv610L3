<?php

namespace controller;

require_once('model/User.php');

class LoginController {

  private $loginView;
  private $loginModel;
  private $layoutView;
  private $sessionModel;

  public function __construct(\view\LoginView $v, \model\LoginModel $lm, \view\layoutView $lv, \model\SessionModel $sm)
  {
    $this->loginView = $v;
    $this->loginModel = $lm;
    $this->layoutView = $lv;
    $this->sessionModel = $sm;
  }

  public function routeToLogin() {
    if($this->loginView->isUsernameValid() && $this->loginView->isPasswordValid()) {
      $user = new \model\User($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword());
      $this->layoutView->setLoggedInStatus($this->loginModel->login($user));
      $this->sessionModel->setSession($this->loginView->getRequestUserName());
    }
  }
  
  public function routeToLoginWithCookie() {
    $this->loginModel->getUserCredentials($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword());
    $this->layoutView->setLoggedInStatus($this->loginModel->login($this->loginView->getCookieName(), $this->loginView->getCookiePassword()));
  }
  
  public function routeToLogout() {
    $this->loginView->removeCookies();
    $this->sessionModel->endSession();
  }
}