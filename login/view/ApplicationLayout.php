<?php

namespace view;

class ApplicationLayout {

  private static $exit = 'WallView::Exit';
  private static $wall = 'WallView::Wall';
  private static $create = 'WallView::Create';
  private static $messageId = 'WallView::MessageId';


  private $postView;
  private $postModel;
  private $wallView;

  private const EMPTY_STRING = '';

  public function __construct(\view\PostView $pv, \model\PostModel $pm, \view\WallView $wv)
  {
    $this->postView = $pv;
    $this->postModel = $pm;
    $this->wallView = $wv;
  }

  public function render() {
    $response = $this->renderWall();
    return $response;
  }

  private function renderWall() {
    $message = self::EMPTY_STRING;
    return '
      <div>
      ' . $this->selectedView() . '
      ' .$this->generateLogoutExitHTML($message). '
      </div>
    ';
  }

  public function selectedView() {
    if($this->userWantsToCreate()) {
      return $this->postView->response();
    } else {
      return $this->wallView->renderPosts();
    }
  }

  private function generateLogoutExitHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$exit . '" value="Exit"/>
				<input type="submit" name="' . self::$create . '" value="create"/>
				<input type="submit" name="' . self::$wall . '" value="wall"/>
        </form>
		';
  }
   
  public function userWantsToExit() : bool {
    return isset($_POST[self::$exit]);
  }

  public function userWantsToCreate() : bool {
    return isset($_POST[self::$create]);
  }

}