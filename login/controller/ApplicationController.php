<?php

namespace controller;

class ApplicationController {



  private $sessionModel;
  private $wallView;
  private $postView;
  private $postModel;
  private $applicationLayout;

  public function __construct(\model\SessionModel $sm, \view\WallView $wv, \view\PostView $pv, \model\PostModel $pm, \view\ApplicationLayout $al)
  {
    $this->sessionModel = $sm;
    $this->wallView = $wv;
    $this->postView = $pv;
    $this->postModel = $pm;
    $this->applicationLayout =  $al;
  }
 
  public function routeToApplication() {
    if($this->postView->userWantsToSubmit()) {
      $this->postModel->submitPost($this->postView->getPost(), $this->postView->getSessionName());
    }

    if($this->wallView->userWantsToEdit()) {
      $this->wallView->setEditStatus($this->postModel->validAuthor($this->postView->getSessionName(), $this->wallView->getPostId()));
    }

    if($this->wallView->userWantsToDelete()){
      echo 'delete';
    }
  }

  public function routeToCreate() {
    $this->postView->response();
  }
  
  public function routeToExit() {
    $this->sessionModel->endApplicationSession();
  }

}