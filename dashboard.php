<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
session_start();
include "frameworks/navbar.inc.php";
include "backend/view.inc.php";

$username = $_SESSION['username'];
$validatesesh = new usersController();
$validatesesh->validatesesh($username);

$user_id = $_SESSION['user_id'];
$validatestatus = new usersController();
$validatestatus->validatestatus($user_id);
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>DashBoard</title>
</head>
<body>
<?php $Tiles = new cliView(); $Tiles->Tiles();?>
<?php $News = new cliView(); $News->News();?>
</body>
