<?php

namespace controller;

class LoginController {

  private $loginView;
  private $loginModel;
  private $layoutView;

  public function __construct(\view\LoginView $v, \model\LoginModel $lm, \view\layoutView $lv)
  {
    $this->loginView = $v;
    $this->loginModel = $lm;
    $this->layoutView = $lv;
  }

  public function routeToLogin() {
    $this->layoutView->setLoggedInStatus($this->loginModel->login($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword()));
  }
  
  public function routeToLoginAndSaveCookie() {
    $this->loginView->setCookies($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword());
    $this->layoutView->setLoggedInStatus($this->loginModel->login($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword()));
    // $this->layoutView->setLoggedInStatus($this->loginView->checkIfCookiesExist());
  }
}