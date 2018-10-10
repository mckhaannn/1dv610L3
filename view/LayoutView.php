<?php

namespace view;

class LayoutView {

  private static $login = 'login';
  private static $register = 'register';
  private static $sessionName = 'user';
  private const EMPTY_STRING = '';
  
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
          ' . $this->renderIsLoggedIn($this->isLoggedIn) . '
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
    if(isset($_GET[self::$register])) {
      $html = 'hi';
    } else {
      $html = $this->loginView->response($this->isLoggedIn);
    }
    return $html;
  }

  /**
   * set logged in status
   */
  public function setLoggedInStatus($loginStatus) {
    $this->isLoggedIn = $loginStatus;
  }
  
  
  /**
   * render logged in status
   */
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
