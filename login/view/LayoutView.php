<?php

namespace view;

class LayoutView {

  private static $login = 'login';
  private static $register = 'register';
  private static $sessionName = 'user';
  private static $application = 'application';


  private const EMPTY_STRING = '';
  
  private $sessionExist;
  private $loginView;
  private $registerView;
  private $isLoggedIn;
  private $dateTimeView;
  private $applicationLayout;

  public function reciveViews($v, $rw, $dtv, $al) {
    $this->loginView = $v;
    $this->registerView = $rw;
    $this->dateTimeView = $dtv;
    $this->applicationLayout = $al;
  }
  /**
   * render the selected view
   */
  public function render() {
    echo '
      <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->generateRegisterUserLink() . '              
          ' . $this->renderIsLoggedIn() . '
          <div class="container">
          ' . $this->setLayout() . '              
          ' . $this->dateTimeView->showTime() . '              
          </div>
        </body>
      </html>';
  }

  /**
   * decides what view to be shown
   * 
   * @return string
   */
  public function setLayout() {
    $html = self::EMPTY_STRING;
    if($this->getRegister()) {
      $html = $this->registerView->response();
    } else if (isset($_SESSION[self::$application])) {
      $html = $this->applicationLayout->render();
    } else if (isset($_SESSION[self::$sessionName])) {
      $html = $this->loginView->loggedInResponse(false);
    } else {
      $html = $this->loginView->loginResponse();
    }
    return $html;
  }
  
  /**
   * render logged in status
   */
  private function renderIsLoggedIn() {
    if(!isset($_SESSION[self::$application])) {
      if (isset($_SESSION[self::$sessionName])) {
        return '<h2>Logged in</h2>';
      }
      else {
        return '<h2>Not logged in</h2>';
      }
    }
  }
  private function generateRegisterUserLink() {
    if(!isset($_SESSION[self::$application])) {
      if(!isset($_SESSION[self::$sessionName])) {
        if($this->getRegister()){
          return '<a href="?">Back to login</a>';
        }
        return '<a href="?' .self::$register . '">Register a new user</a>';
      }
    } 
  }
  
  private function getRegister() {
    return isset($_GET[self::$register]);
  }

}
