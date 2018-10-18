<?php

namespace view;

class LayoutView {

  private static $login = 'login';
  private static $register = 'register';
  private static $sessionName = 'user';

  private const EMPTY_STRING = '';
  
  private $sessionExist;
  private $loginView;
  private $registerView;
  private $isLoggedIn;
  private $dateTimeView;

  public function reciveViews($v, $rw, $dtv) {
    $this->loginView = $v;
    $this->registerView = $rw;
    $this->dateTimeView = $dtv;
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
  public function getSession($sessionStatus) {
    $this->sessionExist = $sessionStatus;
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
    } else  {
      $html = $this->loginView->response($this->sessionExist);
    }
    return $html;
  }
  
  /**
   * render logged in status
   */
  private function renderIsLoggedIn() {
    if ($this->sessionExist) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
  private function generateRegisterUserLink() {
    if(!$this->sessionExist) {
      if($this->getRegister()){
        return '<a href="?">Back to login</a>';
      }
      return '<a href="?' .self::$register . '">Register a new user</a>';
    }
  }
  
  private function getRegister() {
    return isset($_GET[self::$register]);
  }
}
