<?php

//INCLUDE THE FILES NEEDED...
require_once('controller/MainController.php');
require_once('controller/LoginController.php');
require_once('model/LoginModel.php');
require_once('model/SessionModel.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS

$lm = new \model\LoginModel();
$sm = new \model\SessionModel();

$v = new \view\LoginView();
$rv = new \view\RegiterView();
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView();

$lc = new \controller\LoginController($v, $lm, $lv, $sm);
$mc = new \controller\MainController($lc, $lv, $v, $rv);

$mc->redirect();


// $lv->render(, $dtv);

