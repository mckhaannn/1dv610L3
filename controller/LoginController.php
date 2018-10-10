<?php

namespace controller;

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
    $this->layoutView->setLoggedInStatus($this->loginModel->login($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword()));
  }
  
  public function routeToLoginAndSaveCookie() {
    // $this->loginView->setCookies($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword());
    $this->layoutView->setLoggedInStatus($this->loginModel->login($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword()));
    
    // $this->layoutView->setLoggedInStatus($this->loginView->checkIfCookiesExist());
  }
  public function routeToLoginWithCookie() {
    $this->layoutView->setLoggedInStatus($this->loginModel->login($this->loginView->getCookieName(), $this->loginView->getCookiePassword()));
  }
}