<?php

namespace controller;

class LoginController {

  private $loginView;
  private $loginModel;

  public function __construct(\view\LoginView $v, \model\LoginModel $lm)
  {
    $this->loginView = $v;
    $this->loginModel = $lm;
  }

  public function routeToLogin() {
    $this->loginModel($this->loginView->getRequestUserName, $this->loginView->getRequestPassword);
  }
}