<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
include "../frameworks/boot.inc.php";
include "../backend/view.inc.php";
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
       <h5 class="card-title">Log In Cliente</h5>
         <form method="post" action="index.php">
            <input type="text" id="cnpj" class="form-control" name="cnpj" placeholder="CNPJ">
            <br>
            <input type="password" id="password" class="form-control" name="password" placeholder="Senha">
            <br>
            <input type="submit" id="submitbtn" name="submitbtn" class="btn btn-success" value="Entrar">
         </form>
     </div>
   </div>
<script src="../frameworks/jquery.mask.js"></script>

<script type="text/javascript">
 $(document).ready(function(){
  $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
   });
</script>


<?php $cnpj = $_POST['cnpj']; $password = $_POST['password']; $CliLogIn = new cliController(); $CliLogIn->CliLogIn($cnpj, $password); ?>
