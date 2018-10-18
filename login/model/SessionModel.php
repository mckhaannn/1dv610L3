<?php 

namespace model;

class SessionModel {

  private static $sessionName = 'user';
  private static $registerSession = 'registerSuccess';

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

  public function isSession() : bool {
    return isset($_SESSION[self::$sessionName]);
  }

  /**
   * destroy the session
   */
  public function endSession() {
    unset($_SESSION[self::$sessionName]); 
    session_destroy(); 
  }
  public function successfullRegister($newUser) {
    $_SESSION[self::$registerSession] = $newUser;
  }
}