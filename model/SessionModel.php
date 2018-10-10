<?php 

namespace model;

class SessionModel {

  private static $sessionName = 'user';

  public function startSession() {
    if(!isset($_SESSION[self::$sessionName])) {
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
    session_unset(); 
    session_destroy(); 
  }

  // public function 
}