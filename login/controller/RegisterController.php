<?php

namespace controller; 

require_once('login/model/User.php');

class RegisterController {

  private $registerView;
  private $registerModel;
  private $sessionModel;

  public function __construct(\view\RegisterView $rv, \model\RegisterModel $rm, \model\SessionModel $sm, \view\LayoutView $lv)
  {
    $this->registerView = $rv;
    $this->registerModel = $rm;
    $this->sessionModel = $sm;
    $this->layoutView = $lv;
  }

  /**
   * register a new user
   */
  public function routeToRegister() {
    if($this->registerView->checkValidUsernameLenght() && $this->registerView->checkValidPasswordLenght() && $this->registerView->usernameContainsValidCharacters() && $this->registerView->isPasswordEqual()) {
      $user = new \model\User($this->registerView->getRequestRegisterUsername(), $this->registerView->getRequestRegisterPassword());
      $this->layoutView->setLayout($this->registerModel->addUserToDatabase($user));
    }
  }
}