<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
session_start();
include "../frameworks/navbar.inc.php";
include "../backend/view.inc.php";

$username = $_SESSION['username'];
$validatesesh = new usersController();
$validatesesh->validatesesh($username);

$user_id = $_SESSION['user_id'];
$validatestatus = new usersController();
$validatestatus->validatestatus($user_id);
?>

<!DOCTYPE html>
<html>
<head>
	<title>CRM</title>
</head>
<br>
<br>
<br>
<br>

<body>
<?php $quota_id = $_GET['quota_id']; $CliOneQuota = new cliView(); $CliOneQuota->CliOneQuota($quota_id);?>
</body>
</html>
