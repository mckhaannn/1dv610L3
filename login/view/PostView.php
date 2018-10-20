<?php

namespace view;

class PostView {

  private static $submit = 'PostView::Submit';
  private static $post = 'PostView::Post';
  private static $user = 'user';

  public function response() {
    $response = $this->generatePostArea();
    return $response;  
  }
  
  private function generatePostArea() {
    return '
    <form method="post" > 
      <fieldset>
        <legend>Create Post</legend>
        <textarea name="' . self::$post . '" rows="5" cols="40"></textarea>
        <input type="submit" name="' . self::$submit . '" value="submit" />
      </fieldset>
    </form>
    ';
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