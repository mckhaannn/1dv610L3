<?php

namespace model;

class PostValidation {

  private const MAXIMUM_POST_LENGTH = 255;
  private const MINIMUM_POST_LENGTH = 0;

  public function getPostData($post) {
    $this->post = $post;
  }

  public function isValidPost() {
    return  
      $this->minimumPostLength() &&
      $this->maximumPostLength() &&
      $this->isPostContainingValidCharacters();
  }

  public function minimumPostLength() {
    return strlen($this->post) > self::MINIMUM_POST_LENGTH;
  }

  public function maximumPostLength() {
    return strlen($this->post) < self::MAXIMUM_POST_LENGTH;
  }

  public function isPostContainingValidCharacters() {
    return $this->post == $this->stripTagsFromPost();
  }

  public function stripTagsFromPost() {
    return strip_tags($this->post);
  }


}