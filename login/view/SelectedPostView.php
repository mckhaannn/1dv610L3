<?php

namespace view;

class SelectedPostView {

  private static $newPost = "SelectedPostView::NewPost";
  private static $update = "SelectedPostView::Update";
  private static $postId = "SelectedPostView::PostId";

  private const MINIMUM_POST_LENGTH = 0;

  public function render($post, $name, $id) {
    return '
    <form method="post" >
      <fieldset>
        <legend>Created by ' . $name . '</legend>
        <p>' . $id .'</p>
        <textarea name="' . self::$newPost .'" rows="5" cols="40">' . $post . '</textarea>
        <input type="hidden" name="' . self::$postId . '" value="' . $id . '">
        <input type="submit" name="' . self::$update . '" value="update"/>
      </fieldset>
    </form>';
  }

  public function validPostLength() {
    return strlen($this->getNewPost()) > self::MINIMUM_POST_LENGTH;
  }
  
  public function getNewPost() {
    if(isset($_POST[self::$newPost])) {
      return $_POST[self::$newPost];
    }
  }
  public function getPostId() {
    if(isset($_POST[self::$postId])) {
      return $_POST[self::$postId];
    }
  }
  public function userWantsToUpdate() {
    return isset($_POST[self::$update]);
  }
}