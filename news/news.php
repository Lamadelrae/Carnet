<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
session_start();
include "../frameworks/boot.inc.php";
include "../backend/view.inc.php";

$username = $_SESSION['username'];
$validatesesh = new usersController();
$validatesesh->validatesesh($username);
?>
<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#">Notícias</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled" href="#">Desenvolvido por: Sysu Sistemas</a>
    </li>
  </ul>
</nav>