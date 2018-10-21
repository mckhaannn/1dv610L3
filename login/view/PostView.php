<?php

namespace view;

class PostView {

  private static $submit = 'PostView::Submit';
  private static $post = 'PostView::Post';
  private static $messageId = 'PostView::MessageId';
  private static $user = 'user';

  public function render() {
    $message = $this->getMessage();
    $response = $this->generatePostArea($message);
    return $response;  
  }
  
  private function generatePostArea($message) {
    return '
    <form method="post" > 
      <fieldset>
        <legend>Create Post</legend>
        <p id="' . self::$messageId . '">' . $message . '</p>
        <textarea name="' . self::$post . '" rows="5" cols="40"></textarea>
        <input type="submit" name="' . self::$submit . '" value="submit" />
      </fieldset>
    </form>
    ';
  }

  private function getMessage() {
    $message = '';
    if(isset($_POST[self::$submit])) {
      if(!$this->validPostLength()) {
        $message = 'Post is empty';
      }
      return $message;
    }
  }

  public function validPostLength() {
    return strlen($this->getPost()) != 0;
  }

  public function getPost() {
    if(isset($_POST[self::$post])) {
      return $_POST[self::$post];
    }
  }

  public function userWantsToSubmit() {
    return isset($_POST[self::$submit]);
  }

  public function getSessionName() {
    if(isset($_SESSION[self::$user])) {
      return $_SESSION[self::$user];
    }
  }

}