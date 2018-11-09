<?php 

namespace view;

require_once('login/view/Messages.php');

class StatusBoardView {

  private static $delete = 'StatusBoardView::Delete';
  private static $postId = 'StatusBoardView::PostId';
  private static $newPost = 'StatusBoardView::NewPost';
  private static $messageID = 'StatusBoardView::MessageID';
  private static $post = 'StatusBoardView::Post';
  private static $nameOnPost = 'StatusBoardView::NameOnPost';

  private $postModel;

  public function __construct(\model\PostModel $pm)
  {
    $this->postModel = $pm;
  }

  public function render() {
    $showPosts = $this->renderPosts();
    return $showPosts; 
  }
  
  private function renderPosts() {
    $allPosts = \view\Messages::EMPTY_STRING;
    $posts = $this->postModel->retrivePosts();
    if(empty($posts)) {
      $allPosts = \view\Messages::NO_POSTS;
    } else {
      foreach ($posts as $key) {
        $allPosts .= $this->generatePostForm($key->name, $key->post,$key->date, $key->ID);
      }
    }
    return $allPosts;
  }

  private function generatePostForm($name, $post, $date, $id) {
    return '
    <form method="post" >
      <fieldset>
        <legend>Created by ' . $name . '</legend>
        <p>' . $post . '</p>
        <p>' . $date . '<p>
        <input type="hidden" name="' . self::$post . '" value="' . $post . '">
        <input type="hidden" name="' . self::$nameOnPost . '" value="' . $name . '">
        <input type="hidden" name="' . self::$postId . '" value="' . $id . '">
        <input type="submit" name="' . self::$delete . '" value="delete"/>
      </fieldset>
    </form>
  ';
  }


  public function getPost() {
    if(isset($_POST[self::$post])) {
      return $_POST[self::$post];
    }
  }

  public function getName() {
    if(isset($_POST[self::$nameOnPost])) {
      return $_POST[self::$nameOnPost];
    }
  }

  public function getPostId() {
    if(isset($_POST[self::$postId])) {
      return $_POST[self::$postId];
    }
  }

  public function userWantsToDelete() : bool {
    return isset($_POST[self::$delete]);
  }
}