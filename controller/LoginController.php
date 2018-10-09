<?php

namespace controller;

class LoginController {

  private $loginView;

  public function __construct(\view\LoginView $v)
  {
    $this->loginView = $v;
  }
}