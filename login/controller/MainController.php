<?php

namespace controller;

class MainController{ 
  
  private $loginController;
  private $registerController;
  private $layoutView;
  private $loginView;
  private $registerView;
  private $sessionModel;
  private $dateTimeView;
  private $wallLayoutView;

  public function __construct(LoginController $lc, RegisterController $rc, \view\layoutView $lv, \view\LoginView $v, \view\RegisterView $rv, \model\SessionModel $sm, \view\DateTimeView $dtv, \view\WallLayoutView $wlv)
  {
    $this->loginController = $lc;
    $this->registerController = $rc;
    $this->layoutView = $lv;
    $this->loginView = $v;
    $this->registerView = $rv;
    $this->sessionModel = $sm;
    $this->dateTimeView = $dtv;
    $this->wallLayoutView = $wlv;
  }

  public function sendViewsToLayout() {
    $this->layoutView->reciveViews($this->loginView, $this->registerView, $this->dateTimeView, $this->wallLayoutView);
  }

  public function redirect() {

    $this->sendViewsToLayout();

    if($this->sessionModel->isSession()) {

    }
    if($this->loginView->checkIfCookiesExist()) {
      $this->loginController->routeToLoginWithCookie();
    }
    
    if($this->loginView->userWantsToLogut()) {
      $this->loginController->routeToLogout();
    }
    
    if($this->loginView->userWantsToLogin() && !$this->loginView->userWantsToKeepLoggedIn()) {
      $this->loginController->routeToLogin();
    }
    
    if($this->loginView->userWantsToKeepLoggedIn() && $this->loginView->userWantsToLogin()) {
      $this->loginView->setCookies();
      $this->loginController->routeToLogin();
    }
    
    if($this->registerView->userWantsToRegister()) {
      $this->registerController->routeToRegister();
    }
      
    $this->layoutView->render();
  }
}