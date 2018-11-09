<?php

namespace controller;

class ApplicationController {



  private $sessionModel;
  private $statusBoardView;
  private $postView;
  private $postModel;
  private $applicationLayout;
  private $selectedPostView;
  private $postValidation;

  public function __construct(
    \model\SessionModel $sm,
    \view\StatusBoardView $wv,
    \view\PostView $pv,
    \model\PostModel $pm, 
    \view\ApplicationLayout $al,
    \view\SelectedPostView $spv,
    \model\PostValidation $pval
  )
  {
    $this->sessionModel = $sm;
    $this->statusBoardView = $wv;
    $this->postView = $pv;
    $this->postModel = $pm;
    $this->applicationLayout =  $al;
    $this->selectedPostView = $spv;
    $this->postValidation = $pval;
  }
 
  /**
   * check what action has been made
   */
  public function routeToApplication() {
    if($this->postView->userWantsToSubmit()) {
      $this->postValidation->getPostData($this->postView->getPost());
      if($this->postValidation->isValidPost()) {
        $this->postModel->submitPost($this->postView->getPost(), $this->postView->getSessionName());
        $this->applicationLayout->render();
      }
    }

    if($this->statusBoardView->userWantsToDelete()){
      $this->postModel->validAuthor($this->postView->getSessionName(), $this->statusBoardView->getPostId());
      if($this->postModel->isValidAuthor()) {
        $this->postModel->deletePost($this->statusBoardView->getPostId());
      }
    }

    if($this->applicationLayout->userWantsToExit()) {
      $this->sessionModel->endApplicationSession();      
    }

    $this->applicationLayout->render();
  }
}