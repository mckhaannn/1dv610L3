<?php

namespace view;

/**
 * Creates input for a post
 */
class PostView {

  private static $submit = 'PostView::Submit';
  private static $post = 'PostView::Post';
  private static $messageId = 'PostView::MessageId';
  private static $user = 'user';
  private $postModel;
  private $postValidation;

  public function __construct(\model\PostModel $pm, \model\PostValidation $pval)
  {
    $this->postModel = $pm;
    $this->postValidation = $pval;
  }

  public function render() {
    $message = $this->setMessages();
    $response = $this->generatePostForm($message);
    return $response;  
  }
  
  /**
   * creates a text area 
   */
  private function generatePostForm($message) {
    return '
    <form method="post" > 
      <fieldset>
        <legend>Create Post</legend>
				<p id="' . self::$messageId . '">' . $message . '</p>        
        <textarea name="' . self::$post . '" rows="5" cols="40">' . $this->savePost() . '</textarea>
        <input type="submit" name="' . self::$submit . '" value="submit" />
      </fieldset>
    </form>
    ';
  }

  public function setMessages() {
    $messages = '';
    if($this->userWantsToSubmit()) {
      if(!$this->postValidation->minimumPostLength()) {
        $messages .= \view\Messages::POST_TO_SHORT;
      } 
      if(!$this->postValidation->maximumPostLength()) {
        $messages .= \view\Messages::POST_TO_LONG;
      }
      if(!$this->postValidation->isPostContainingValidCharacters()) {
        $messages .= \view\Messages::POST_CONTAINS_INVALID_CHARACTERS;
      }
      if($this->postModel->isPostAdded()) {
        $messages .= \view\Messages::POST_WAS_ADDED;
      }
    } 
    return $messages;
  }

  private function savePost() {
    return strip_tags($this->getPost());
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