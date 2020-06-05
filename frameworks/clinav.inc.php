<?php include "boot.inc.php"; session_start();?>

<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#"><b>SGEPJ</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/projects/SGEPJ/cli_area/dashboard_cli.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Usuário: <?php  echo $_SESSION['cnpj']; ?> </a>
      </li>
    <form method="post" action="/projects/SGEPJ/frameworks/navbar.inc.php">
      <button style="font-size:12px; position:relative; top:5px;" class="btn btn-danger" type="submit" id="logout" name="logout">Log Out</button>
    </form>
  </ul>
</nav>

<?php 
if(isset($_POST['logout']))
{
      header("Location:/projects/SGEPJ/index.php");
      session_destroy();
}
?>