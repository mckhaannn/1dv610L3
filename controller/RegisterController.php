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
    try{
      if($this->registerView->checkValidUsernameLenght() && $this->registerView->checkValidPasswordLenght() && $this->registerView->usernameContainsValidCharacters() && $this->registerView->isPasswordEqual()) {
        $user = new \model\User($this->registerView->getRequestRegisterUsername(), $this->registerView->getRequestRegisterPassword());
        $this->registerModel->addUserToDatabase($user);
      }
    } catch (\Exception $e) {
      $this->registerView->setMessage($e->getMessage());
    }
  }

}