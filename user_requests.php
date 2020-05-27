<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
session_start();
include "frameworks/navbar.inc.php";
include "backend/view.inc.php";

$username = $_SESSION['username'];
$validatesesh = new usersController();
$validatesesh->validatesesh($username);
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>User Requests</title>
</head>
<body>
	<?php $UserRequests = new usersView(); $UserRequests->user_requests();?>
</body>
