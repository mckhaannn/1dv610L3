<?php

namespace controller; 

require_once('model/User.php');

class RegisterController {

  private $registerView;
  private $registerModel;

  public function __construct(\view\RegisterView $rv, \model\RegisterModel $rm)
  {
    $this->registerView = $rv;
    $this->registerModel = $rm;
  }

  public function routeToRegister() {
    var_dump($this->registerView->getRequestRegisterUsername());
    var_dump($this->registerView->getRequestRegisterPassword());
    // var_dump($this->registerView->checkValidUsernameLenght());
    // var_dump($this->registerView->checkValidPasswordLenght());
    // var_dump( $this->registerView->usernameContainsValidCharacters());
    // var_dump($this->registerView->isPasswordEqual());
    if($this->registerView->checkValidUsernameLenght() && $this->registerView->checkValidPasswordLenght() && $this->registerView->usernameContainsValidCharacters() && $this->registerView->isPasswordEqual()) {
      $user = new \model\User($this->registerView->getRequestRegisterUsername(), $this->registerView->getRequestRegisterPassword());
      $this->registerModel->addUserToDatabase($user);
    }
  }
}