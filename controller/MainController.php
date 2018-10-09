<?php

namespace controller;

class MainController{ 
  
  private $loginView;
  private $layoutView;
  public function __construct(\view\layoutView $lv, \view\LoginView $v)
  {
    $this->loginView = $v;
    $this->layoutView = $lv;
  }

  public function render() {

  }
}