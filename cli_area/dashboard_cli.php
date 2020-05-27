<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
session_start();
include "../frameworks/clinav.inc.php";
include "../backend/view.inc.php";

$cnpj = $_SESSION['cnpj'];
$cli_id = $_SESSION['cli_id'];
$validatesesh = new usersController();
$validatesesh->validatesesh($cnpj);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<br>
<body>
<?php $CliQuotaCliArea = new cliView(); $CliQuotaCliArea->CliQuotaCliArea($cli_id);  ?>
</body>
</html>