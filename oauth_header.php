<?php
ob_start("ob_gzhandler");
error_reporting(0);
session_start();
include 'includes/db.php';
include 'includes/Wall_Updates.php';
$Wall = new Wall_Updates($db);
include 'OauthLogin.php';
$OauthLogin = new OauthLogin($db);
$userSession=$_SESSION['userSession'];

?>