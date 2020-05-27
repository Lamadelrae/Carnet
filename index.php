<?php 
include "frameworks/boot.inc.php";
include "backend/view.inc.php";
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="d-flex justify-content-center">
   <div class="card bg-light mb-3" style="width: 25rem;">
     <div class="card-header"> <i style="font-size:60px;" class="fas fa-users"></i></div>
     <div class="card-body">
       <h5 class="card-title">Log In</h5>
         <form method="post" action="index.php">
            <input type="text" id="login" class="form-control" name="username" placeholder="Username">
            <br>
            <input type="password" id="password" class="form-control" name="password" placeholder="Senha">
            <br>
            <input type="submit" id="submitbtn" name="submitbtn" class="btn btn-success" value="Entrar">
         </form>
       <a class="btn btn-primary" href="cli_area/index.php">Área do cliente</a>
       <br>
       <br>
       <a class="btn btn-primary" href="register.php">Não tem cadastro? Se cadastre aqui.</a>
       <br>
       <br>
     </div>
     <div name="txt" id="txt">
     </div>
   </div>
<?php 

  if(isset($_POST['submitbtn']))
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $registeruser = new usersController();

    $registeruser->loginUser($username, $password);
    
  }
?>

