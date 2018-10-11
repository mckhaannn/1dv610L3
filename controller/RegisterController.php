<?php

namespace controller; 

class RegisterController {

  private $registerView;

  public function __construct(\view\RegisterView $rv)
  {
    $this->registerView = $rv;
  }

  
}