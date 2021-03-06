<?php

//INCLUDE THE FILES NEEDED...
require_once('login/controller/MainController.php');
require_once('login/controller/LoginController.php');
require_once('login/controller/RegisterController.php');
require_once('login/controller/ApplicationController.php');
require_once('login/model/LoginModel.php');
require_once('login/model/registerModel.php');
require_once('login/model/SessionModel.php');
require_once('login/model/PostModel.php');
require_once('login/model/UserCredentials.php');
require_once('login/model/PostValidation.php');
require_once('login/view/LoginView.php');
require_once('login/view/DateTimeView.php');
require_once('login/view/LayoutView.php');
require_once('login/view/RegisterView.php');
require_once('login/view/PostView.php');
require_once('login/view/SelectedPostView.php');
require_once('login/view/ApplicationLayout.php');
require_once('login/view/StatusBoardView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//APPLICATION
//LOGIN 
$lm = new \model\LoginModel();
$rm = new \model\RegisterModel();
$sm = new \model\SessionModel();
$uc = new \model\UserCredentials();

$pm = new \model\PostModel();
$pval = new \model\PostValidation();

$spv = new \view\SelectedPostView();
$v = new \view\LoginView($lm);
$rv = new \view\RegisterView($uc);
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView();

$pv = new \view\PostView($pm, $pval);
$wv =  new \view\StatusBoardView($pm);
$al = new \view\ApplicationLayout($pv, $pm, $wv, $spv);

$ac = new \controller\ApplicationController($sm, $wv, $pv, $pm, $al, $spv, $pval);
$rc = new \controller\RegisterController($rv, $rm, $sm, $lv, $uc);
$lc = new \controller\LoginController($v, $lm, $lv, $sm);
$mc = new \controller\MainController($lc, $rc, $ac, $lv, $v, $rv, $sm, $dtv, $al);




$sm->startSession();
$ac->routeToApplication();
$mc->redirect();



