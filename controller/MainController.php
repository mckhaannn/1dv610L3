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

    if($this->loginView->checkForLoginPost()) {
      echo 'hi';
    }
  }
}