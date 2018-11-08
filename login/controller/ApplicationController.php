<?php

namespace controller;

class ApplicationController {



  private $sessionModel;
  private $StatusBoardView;
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
    $this->StatusBoardView = $wv;
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
      }
    }
    if($this->selectedPostView->userWantsToUpdate()) {
      if($this->selectedPostView->minimumPostLength() && $this->selectedPostView->maximumPostLength()) {
        $this->postModel->updatePost(
          $this->selectedPostView->getNewPost(),
          $this->postView->getSessionName(),
          $this->selectedPostView->getPostId()
        );
      }
    }
    if($this->StatusBoardView->userWantsToDelete()){
      $this->postModel->deletePost($this->StatusBoardView->getPostId());
    }
    if($this->applicationLayout->userWantsToExit()) {
      $this->sessionModel->endApplicationSession();      
    }
    $this->applicationLayout->render();
  }
  

}