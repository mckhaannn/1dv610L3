<?php

namespace controller;

class ApplicationController {



  private $sessionModel;
  private $wallView;
  private $postView;
  private $postModel;
  private $applicationLayout;
  private $selectedPostView;

  public function __construct(\model\SessionModel $sm, \view\WallView $wv, \view\PostView $pv, \model\PostModel $pm, \view\ApplicationLayout $al, \view\SelectedPostView $spv)
  {
    $this->sessionModel = $sm;
    $this->wallView = $wv;
    $this->postView = $pv;
    $this->postModel = $pm;
    $this->applicationLayout =  $al;
    $this->selectedPostView = $spv;
  }
 
  public function routeToApplication() {
    if($this->postView->userWantsToSubmit()) {
      if($this->postView->validPostLength()) {
        $this->postModel->submitPost($this->postView->getPost(), $this->postView->getSessionName());
      }
    }
    if($this->selectedPostView->userWantsToUpdate()) {
      if($this->selectedPostView->validPostLength()) {
        $this->postModel->updatePost($this->selectedPostView->getNewPost(), $this->postView->getSessionName(), $this->selectedPostView->getPostId());
      }
    }
    if($this->wallView->userWantsToDelete()){
      $this->postModel->deletePost($this->wallView->getPostId());
    }
    $this->applicationLayout->render();
  }

  public function routeToCreate() {
    $this->postView->response();
  }
  
  public function routeToExit() {
    $this->sessionModel->endApplicationSession();
  }

}