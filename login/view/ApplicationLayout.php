<?php

namespace view;

class ApplicationLayout {

  private static $exit = 'StatusBoardView::Exit';
  private static $wall = 'StatusBoardView::Wall';
  // private static $create = 'StatusBoardView::Create';
  private static $edit = 'StatusBoardView::Edit';
  private static $messageId = 'StatusBoardView::MessageId';
  
  private static $create = 'create';
  // private static $edit = 'edit';
  private static $walls = '';

  private $postView;
  private $postModel;
  private $StatusBoardView;
  private $selectedPostView;
  private $validEdit;

  private const EMPTY_STRING = '';

  public function __construct(\view\PostView $pv, \model\PostModel $pm, \view\StatusBoardView $wv,\view\SelectedPostView $spv )
  {
    $this->postView = $pv;
    $this->postModel = $pm;
    $this->statusBoardView = $wv;
    $this->selectedPostView = $spv;
  }

  /**
   * render application
   */
  public function render() {
    $response = $this->renderWall();
    return $response;
  }


  /**
   * creates a div with application content
   */
  private function renderWall() {
    return '
      <div>
      ' . $this->deleteMessage() . '
      ' . $this->selectedView() . '
      ' .$this->generateLogoutExitHTML(). '
      </div>';
  }

  /**
   * select what view to show
   */
  public function selectedView() {
    // var_dump($this->statusBoardView->userWantsToDelete());
    if($this->userWantsToCreate()) {
      return $this->postView->render();
    } else if(isset($_POST[self::$edit])) {
      return $this->selectedPostView->render($this->statusBoardView->getPost(), $this->statusBoardView->getName(), $this->statusBoardView->getPostId());
    } else {
      return $this->statusBoardView->renderPosts();
    }
  }

  private function generateLogoutExitHTML() {
		return '
      <form  method="post" >
        <a href="?' .self::$create . '">createStatus</a>
        <a href="?' .self::$walls . '">StatusBoard</a>
        <input type="submit" name="' . self::$exit . '" value="Exit"/>
      </form>
    ';
  }

  private function deleteMessage() {
    $message = \view\Messages::EMPTY_STRING;
    if($this->statusBoardView->userWantsToDelete()) {
      $message = \view\Messages::POST_DELETED . $this->statusBoardView->getPostId();
    } else {
      $message = \view\Messages::EMPTY_STRING;
    }
    return $message;
  }
  public function userWantsToExit() : bool {
    return isset($_POST[self::$exit]);
  }

  public function userWantsToCreate() : bool {
    return isset($_GET[self::$create]);
  }
}