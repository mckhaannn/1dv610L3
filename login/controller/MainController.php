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
  private $applicationLayout;
  private $applicationController;

  public function __construct(LoginController $lc, RegisterController $rc, ApplicationController $ac, \view\layoutView $lv, \view\LoginView $v, \view\RegisterView $rv, \model\SessionModel $sm, \view\DateTimeView $dtv, \view\ApplicationLayout $al)
  {
    $this->loginController = $lc;
    $this->registerController = $rc;
    $this->applicationController = $ac;
    $this->layoutView = $lv;
    $this->loginView = $v;
    $this->registerView = $rv;
    $this->sessionModel = $sm;
    $this->dateTimeView = $dtv;
    $this->applicationLayout = $al;
  }

  public function sendViewsToLayout() {
    $this->layoutView->reciveViews($this->loginView, $this->registerView, $this->dateTimeView, $this->applicationLayout);
  }

  public function redirect() {

    $this->sendViewsToLayout();

    if($this->sessionModel->isLoggedInSession()) {

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

    if($this->loginView->goToPostWall()) {
    $this->sessionModel->setApplicationSession(true);

      // $this->applicationController->routeToApplication();
    }

    if($this->applicationLayout->userWantsToExit()) {
      $this->applicationController->routeToExit();
    }

    // if($this->wallView->userWantsToCreate()) {
    //   $this->applicationController->routeToCreate();
    // }
      
    $this->layoutView->render();
  }
}