<?php 

namespace model;

class SessionModel {

  private $sessionName = 'user';

  /**
   * create session with user
   */
  public function setSession($user) {
    session_start();
    $_SESSION[$sessionName] = $user;
  }

  /**
   * destroy the session
   */
  public function endSession() {
    session_unset(); 
    session_destroy(); 
  }
}