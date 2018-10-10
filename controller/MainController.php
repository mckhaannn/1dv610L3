<?php

namespace controller;

class MainController{ 
  
  private $loginController;
  private $layoutView;
  private $loginView;
  private $registerView;
  private $sessionModel;
  private $dateTimeView;

  public function __construct(LoginController $lc, \view\layoutView $lv, \view\LoginView $v, \view\RegiterView $rv, \model\SessionModel $sm, \view\DateTimeView $dtv)
  {
    $this->loginController = $lc;
    $this->layoutView = $lv;
    $this->loginView = $v;
    $this->registerView = $rv;
    $this->sessionModel = $sm;
    $this->dateTimeView = $dtv;
  }

  public function sendViewsToLayout() {
    $this->layoutView->reciveViews($this->loginView, $this->registerView, $this->dateTimeView);
  }

  public function redirect() {

    $this->sendViewsToLayout();

    if($this->loginView->checkIfCookiesExist()) {
      $this->loginController->routeToLoginWithCookie();
    }

    if($this->loginView->userWantsToLogut()) {
      $this->loginController->routeToLogout();
    }

    if($this->loginView->userWantsToLogin() && !$this->loginView->userWantsToKeepLoggedIn()) {
      $this->loginController->routeToLogin();
      echo 'user want to login';
    }

    if($this->loginView->userWantsToKeepLoggedIn() && $this->loginView->userWantsToLogin()) {
      $this->loginView->setCookies();
      $this->loginController->routeToLogin();
      echo 'user wants to login and be kept logged in';
    }

    if($this->loginView->userWantsToRegister()) {
      echo 'user wants to register a new account';
    }

    $this->layoutView->render();
  }
}