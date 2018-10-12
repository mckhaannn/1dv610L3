<?php

//INCLUDE THE FILES NEEDED...
require_once('controller/MainController.php');
require_once('controller/LoginController.php');
require_once('model/LoginModel.php');
require_once('model/registerModel.php');
require_once('model/SessionModel.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('controller/RegisterController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$lm = new \model\LoginModel();
$rm = new \model\RegisterModel();
$sm = new \model\SessionModel();

$v = new \view\LoginView($lm);
$rv = new \view\RegisterView();
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView();

$rc = new \controller\RegisterController($rv, $rm);
$lc = new \controller\LoginController($v, $lm, $lv, $sm);
$mc = new \controller\MainController($lc, $rc, $lv, $v, $rv, $sm, $dtv);

$sm->startSession();
$mc->redirect();



