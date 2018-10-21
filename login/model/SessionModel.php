<?php 

namespace model;

class SessionModel {

  private static $sessionName = 'user';
  private static $registerSession = 'registerSuccess';
  private static $application = 'application';

  /**
   * start session
   */
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

  /**
   * creates a session for the application
   */
  public function setApplicationSession($app) {
    $_SESSION[self::$application] = $app;
  }

  public function isApplicationSession() : bool {
    return isset($_SESSION[self::$application]);
  }

  /**
   * destroy session for user
   */
  public function endLoginSession() {
    unset($_SESSION[self::$sessionName]); 
    session_destroy(); 
  }
  
  /**
   * destroy session for application
   */
  public function endApplicationSession() {
    unset($_SESSION[self::$application]);
    session_destroy(); 
  }

}