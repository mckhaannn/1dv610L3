<?php 

namespace view;

class wallView {

  public function render() {
    $response = $this->renderWall();
    return $response;
  }

  private function renderWall() {
    return '<p>Hey</p>';
  }
}