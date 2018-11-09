<?php

namespace view;

class ApplicationLayout {

  private static $exit = 'StatusBoardView::Exit';
  private static $wall = 'StatusBoardView::Wall';
  private static $messageId = 'StatusBoardView::MessageId';
  private static $create = 'create';
  private static $statusBoard = '';

  private $postView;
  private $postModel;
  private $StatusBoardView;
  private $selectedPostView;

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
      ' . $this->displayMessage() . '
      ' . $this->selectedView() . '
      ' .$this->generateLogoutExitHTML(). '
      </div>';
  }

  /**
   * select what view to show
   */
  public function selectedView() {
    if($this->userWantsToCreate()) {
      return $this->postView->render();
    } else {
      return $this->statusBoardView->render();
    }
  }

  private function generateLogoutExitHTML() {
		return '
      <form  method="post" >
      <input type="submit" name="' . self::$exit . '" value="Exit"/>
        <a href="?' .self::$create . '">createStatus</a>
        <a href="?' .self::$statusBoard . '">StatusBoard</a>
      </form>
    ';
  }

  private function displayMessage() {
    $message = \view\Messages::EMPTY_STRING;
    if($this->statusBoardView->userWantsToDelete() && $this->postModel->isValidAuthor()) {
      $message = \view\Messages::POST_DELETED;
    } else if ($this->statusBoardView->userWantsToDelete() && !$this->postModel->isValidAuthor()) {
      $message = \view\Messages::NOT_VALID_AUTHOR;
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