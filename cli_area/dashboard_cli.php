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
	<div class='container'>
		<div class='row'>
			<div class='col'><?php $CliQuotaCliArea = new cliView(); $CliQuotaCliArea->CliQuotaCliArea($cli_id); ?></div>
			<div class='col'>
				<h4> Posts: </h4>
				<?php $ViewPosts = new postsView(); $ViewPosts->ViewAllPosts();?>	
			</div>
		</div>	
	</div>
</body>
</html>