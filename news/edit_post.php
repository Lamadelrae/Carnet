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

$validatetype = new usersController();
$validatetype->validatetype($user_id);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar Post</title>
</head>
<body>
<?php $post_id = $_GET['post_id']; $EditPost = new postsView(); $EditPost->ViewPost($post_id); ?>
</body>
</html>