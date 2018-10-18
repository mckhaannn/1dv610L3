<?php

namespace view;

class WallLayoutView {

  private $wallView;

  public function __construct(\view\WallView $wv)
  {
    $this->wallView = $wv;
  }

  public function test() {
    echo 'hi';
  }

  public function render() {
    echo '
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title>Post Wall</title>
      </head>
      <body>
        <div class="container">
        ' . $this->wallView->render() . '
        </div>
      </body>
    </html>';
  }
}