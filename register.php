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
     <div class="card-header"> <i style="font-size:60px;" class="fas fa-user-plus"></i></div>
     <div class="card-body">
       <h5 class="card-title">Cadastro</h5>
       <small> *Seu cadastro será enviado, e será passado por um processo de aprovação*</small>
       <br>
       <br>
         <form method="post" action="register.php">
            <input type="text" id="login" class="form-control" name="username" placeholder="Username">
            <br>
            <input type="password" id="password" class="form-control" name="password" placeholder="Senha">
            <br>
            <input type="submit" id="register-btn" name="register-btn" class="btn btn-success" value="Registrar">
         </form>   
       <?php 

      if(isset($_POST['register-btn']))
      {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $registeruser = new usersController();
    
        $registeruser->registerUser($username, $password);
            
      }
 ?>
     </div>
   </div>

