<?php

namespace controller;

class MainController{ 
  
  private $loginController;
  private $layoutView;
  private $loginView;

  public function __construct(LoginController $lc, \view\layoutView $lv, \view\LoginView $v)
  {
    $this->loginController = $lc;
    $this->layoutView = $lv;
    $this->loginView = $v;
  }

  public function redirect() {

    if($this->loginView->userWantsToLogin() && !$this->loginView->userWantsToKeepLoggedIn()) {
      $this->loginController->routeToLogin();
      echo 'user want to login';
    }
    if($this->loginView->userWantsToKeepLoggedIn() && $this->loginView->userWantsToLogin()) {
      echo 'user wants to login and be kept logged in';
    }
    if($this->loginView->userWantsToRegister()) {
      echo 'user wants to register a new account';
    }
  }
}