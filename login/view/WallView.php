<?php 

namespace view;

class WallView {

  private static $edit = 'WallView::Edit';
  private static $delete = 'WallView::Delete';
  private static $postId = 'WallView::PostId';
  private static $newPost = 'WallView::NewPost';

  private static $post = 'WallView::Post';
  private static $nameOnPost = 'WallView::NameOnPost';

  private const EMPTY_STRING = '';

  private $postModel;

  public function __construct(\model\PostModel $pm)
  {
    $this->postModel = $pm;
  }

  public function renderPosts() {
    $allPosts = self::EMPTY_STRING;
    $posts = $this->postModel->retrivePosts();
    for($i = 0; $i < count($posts); $i++) {
      $allPosts .= $this->generatePostForm($posts[$i]->name, $posts[$i]->post,$posts[$i]->date, $posts[$i]->ID);
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
        <input type="submit" name="' . self::$edit . '" value="edit"/>
        <input type="submit" name="' . self::$delete . '" value="delete"/>
      </fieldset>
    </form>
  ';
  }
 
  public function userWantsToEdit() : bool {
    return isset($_POST[self::$edit]);
  }
  
  public function userWantsToDelete() : bool {
    return isset($_POST[self::$delete]);
  }
  public function getPost() {
    return $_POST[self::$post];
  }
  public function getName() {
    return $_POST[self::$nameOnPost];
  }
  public function getPostId() {
    return $_POST[self::$postId];
  }
}