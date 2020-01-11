<?php

	$db = mysqli_connect("localhost", "vrcred62_ROOT", "password", "vrcred62_carnet"); 
    
	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		$sql= mysqli_query($db, "SELECT * FROM status WHERE id_parcela='$id'");
		$row= mysqli_fetch_array($sql);
	}
 
	if(isset($_POST['status'])){
		$newstatus = $_POST['status'];
		$id  = $_POST['id'];
		$sql2  = "UPDATE status SET Parcela_Status='$newstatus' WHERE id_parcela='$id'";
		$result = mysqli_query($db, $sql2) or die("Could not update".mysqli_error($db));
	    header("Location: superusuario.php");
	}
 
?>
  <head>
  <meta charset='utf-8'> 
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="superusuario.php">Voltar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <a class="nav-link" target="_blank" href="contratos.php">Contratos</a>
        <a class="nav-link" target="_blank" href="login_investidor/index.html">Login Investidor</a>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cadastro
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" target="_blank" href="register_cliente/index.html">Cadastro Cliente</a>
          <a class="dropdown-item" target="_blank"href="register_investidor/index.html">Cadastro Investidor</a>
          <a class="dropdown-item" target="_blank" href="register_contratos/index.html">Cadastro Contrato</a>
        </div>
      </li>
      <li class="nav-item">
        <a style="color:red;" class="nav-link" href="index.html">LOG OFF</a>
      </li>
    </ul>
  </div>
     <div class="left">
     <span class="navbar-text">
      <a href="#" style="color:white"> Usuário Ativo: <b>ROOT</b></a>
    </span>
  </div>
</nav>
</head>

   <br>
   <br>
   <br>
<body style="background-color:#A0A0A0;">
 <form class="container" action="edit.php" method="POST">
 <div class="container">
  <div class="form-group">
 ID PARCELA BD: <?php echo $row['id_parcela']; ?>  
   <br>  
    <input  type="radio" name="status" id="status" value="Pago"> Pago
    <br>
    <input  type="radio" name="status" id="status" value="Pendente"> Pendente 
    <br>
    <input  type="radio" name="status" id="status" value="Juros"> Juros
    <br>
    <input type="hidden" name="id" id="id" value="<?php echo $row['id_parcela']; ?>">
  </div>
<input class="btn btn-primary" type="submit" value="Editar">
</div>
</form>
</body>