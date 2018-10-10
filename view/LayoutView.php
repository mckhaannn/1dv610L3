<?php

namespace view;

class LayoutView {

  private static $login = 'login';
  private static $register = 'register';
  private const EMPTY_STRING = '';
  
  private $loginView;
  private $registerView;

  public function reciveViews($v, $rw) {
    $this->loginView = $v;
    $this->registerView = $rw;
  }

  public function setLayout() {
    $html = EMPTY_STRING;
    if(isset($_POST[self::$login])) {
      $html = 'hi';
    } else {
      $html = $this->loginView->response();
    }
    return $html;
  }
  
  
  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $v->response() . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
