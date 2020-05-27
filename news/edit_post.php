<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
session_start();
include "../frameworks/navbar.inc.php";
include "../backend/view.inc.php";

$username = $_SESSION['username'];
$validatesesh = new usersController();
$validatesesh->validatesesh($username);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar Post</title>
</head>
<body>
<?php $post_id = $_GET['post_id']; $EditPost = new postsView(); $EditPost->EditPost($post_id); ?>
</body>
</html>