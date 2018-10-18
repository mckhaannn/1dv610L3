<?php

//INCLUDE THE FILES NEEDED...
require_once('login/controller/MainController.php');
require_once('login/controller/LoginController.php');
require_once('login/model/LoginModel.php');
require_once('login/model/registerModel.php');
require_once('login/model/SessionModel.php');
require_once('login/view/LoginView.php');
require_once('login/view/DateTimeView.php');
require_once('login/view/LayoutView.php');
require_once('login/view/RegisterView.php');
require_once('login/controller/RegisterController.php');

require_once('application/view/WallView.php');
require_once('application/view/WallLayoutView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//APPLICATION
$wv =  new \view\WallView();
$wlv = new \view\WallLayoutView($wv);

//LOGIN 
$lm = new \model\LoginModel();
$rm = new \model\RegisterModel();
$sm = new \model\SessionModel();

$v = new \view\LoginView($lm);
$rv = new \view\RegisterView();
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView();

$rc = new \controller\RegisterController($rv, $rm, $sm, $lv);
$lc = new \controller\LoginController($v, $lm, $lv, $sm);
$mc = new \controller\MainController($lc, $rc, $lv, $v, $rv, $sm, $dtv, $wlv);




$sm->startSession();
$mc->redirect();



