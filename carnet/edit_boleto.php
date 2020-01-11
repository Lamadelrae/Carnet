<?php
  

	$db = mysqli_connect("localhost", "vrcred62_ROOT", "password", "vrcred62_carnet"); 
    
	if( isset($_GET['boleto'])){   
		$cnpj= $_GET['cnpj'];
		$boleto = $_GET['boleto'];
		$sql= mysqli_query($db, "SELECT * FROM users WHERE boleto= '$boleto' AND cnpj='$cnpj' ");
		$row= mysqli_fetch_array($sql);
	}
	if( isset($_POST['newboleto']) )
	{
		$newboleto = $_POST['newboleto'];
		$id_boleto  = $_POST['id_boleto'];
		$id_cnpj  = $_POST['id_cnpj'];
		$sql2  = "UPDATE users SET boleto='$newboleto' WHERE boleto='$id_boleto' AND cnpj = '$id_cnpj' ";
		$result = mysqli_query($db, $sql2) or die("Could not update".mysqli_error($db));
        header("Location: superusuario.php");
	}

 
?>
<html>
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
<form class="container" action="edit_boleto.php" method="POST">
	<div class="container">
  <div class="form-group">
Boleto Atual: <?php echo $row['boleto']; ?>
<br>
Boleto Link:
   <input class="form-control" type="text" name="newboleto" id="newboleto" value="<?php echo $row['boleto']; ?>">
   <input type="hidden" name="id_boleto" id="id_boleto" value="<?php echo $row['boleto']; ?>">
   <input type="hidden" name="id_cnpj" id="id_cnpj" value="<?php echo $row['cnpj']; ?>">
  </div>
    <input class="btn btn-primary"type="submit" value="Editar">
   </div>
</form>
</body>

</html>