<?php

namespace view;

class ApplicationLayout {

  private static $exit = 'WallView::Exit';
  private static $wall = 'WallView::Wall';
  private static $edit = 'WallView::Edit';
  private static $create = 'WallView::Create';
  private static $messageId = 'WallView::MessageId';


  private $postView;
  private $postModel;
  private $wallView;
  private $selectedPostView;
  private $validEdit;

  private const EMPTY_STRING = '';

  public function __construct(\view\PostView $pv, \model\PostModel $pm, \view\WallView $wv,\view\SelectedPostView $spv )
  {
    $this->postView = $pv;
    $this->postModel = $pm;
    $this->wallView = $wv;
    $this->selectedPostView = $spv;
  }

  public function render() {
    $response = $this->renderWall();
    return $response;
  }

  private function renderWall() {
    return '
      <div>
      ' . $this->selectedView() . '
      ' .$this->generateLogoutExitHTML(). '
      </div>';
  }

  public function selectedView() {
    if($this->userWantsToCreate()) {
      return $this->postView->render();
    } else if(isset($_POST[self::$edit])) {
      return $this->selectedPostView->render($this->wallView->getPost(), $this->wallView->getName(), $this->wallView->getPostId());
    } else {
      return $this->wallView->renderPosts();
    }
  }

  private function generateLogoutExitHTML() {
		return '
			<form  method="post" >
				<input type="submit" name="' . self::$exit . '" value="Exit"/>
				<input type="submit" name="' . self::$create . '" value="create"/>
				<input type="submit" name="' . self::$wall . '" value="wall"/>
        </form>
		';
  }
   
  public function setEditStatus($status) {
    $this->validEdit = $status;
    var_dump($this->validEdit);
  }

  public function userWantsToExit() : bool {
    return isset($_POST[self::$exit]);
  }

  public function userWantsToCreate() : bool {
    return isset($_POST[self::$create]);
  }

  

}