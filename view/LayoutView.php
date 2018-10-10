<?php

namespace view;

class LayoutView {

  private static $login = 'login';
  private static $register = 'register';
  private const EMPTY_STRING = '';
  
  private $loginView;
  private $registerView;
  private $isLoggedIn;

  public function reciveViews($v, $rw) {
    $this->loginView = $v;
    $this->registerView = $rw;
  }

  
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
    if(isset($_POST[self::$register])) {
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
