<?php 

namespace model;

class SessionModel {

  private static $sessionName = 'user';
  private static $registerSession = 'registerSuccess';
  private static $application = 'application';

  public function startSession() {
    if(!isset($_SESSION[self::$sessionName]) || !isset($_SESSION[self::$registerSession])) {
      \session_start();
    }
  } 
  /**
   * create session with user
   */
  public function setSession($user) {
    $_SESSION[self::$sessionName] = $user;
  }

  public function isLoggedInSession() : bool {
    return isset($_SESSION[self::$sessionName]);
  }

  public function setApplicationSession($user) {
    $_SESSION[self::$application] = $user;
  }

  public function isApplicationSession() : bool {
    return isset($_SESSION[self::$application]);
  }

  /**
   * destroy the session
   */
  public function endLoginSession() {
    unset($_SESSION[self::$sessionName]); 
    session_destroy(); 
  }
  
  public function endApplicationSession() {
    unset($_SESSION[self::$application]);
    session_destroy(); 
  }

  public function successfullRegister($newUser) {
    $_SESSION[self::$registerSession] = $newUser;
  }
}