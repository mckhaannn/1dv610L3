<?php

namespace controller; 

require_once('login/model/User.php');

class RegisterController {

  private $registerView;
  private $registerModel;
  private $sessionModel;
  private $userCredentials;

  public function __construct(
    \view\RegisterView $rv,
    \model\RegisterModel $rm,
    \model\SessionModel $sm,
    \view\LayoutView $lv,
    \model\UserCredentials $uc
  )
  {
    $this->registerView = $rv;
    $this->registerModel = $rm;
    $this->sessionModel = $sm;
    $this->layoutView = $lv;
    $this->userCredentials = $uc;
  }

  /**
   * register a new user
   */
  public function routeToRegister() {
    $user = new \model\User($this->registerView->getRequestRegisterUsername(), $this->registerView->getRequestRegisterPassword());
    $this->userCredentials->setUser($user);
    if($this->userCredentials->validCredentials()) {
      $this->registerModel->addUserToDatabase($user);
      $this->layoutView->setLayout($this->registerModel->getRegisterStatus());
    }
  }
}