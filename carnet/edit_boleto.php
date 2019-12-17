<?php

    include "CadastroCliente.php";

	$db = mysqli_connect("localhost", "root", "", "carnet"); 
    
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
	    header("Location: SuperUsuario.php");
	}

 
?>


<form  class ="container" action="edit_boleto.php" method="POST">
Boleto Atual: <?php echo $row['boleto']; ?>
<br>
Boleto Link:
<input type="text" name="newboleto" id="newboleto" value="<?php echo $row['boleto']; ?>">
<input type="hidden" name="id_boleto" id="id_boleto" value="<?php echo $row['boleto']; ?>">
<input type="hidden" name="id_cnpj" id="id_cnpj" value="<?php echo $row['cnpj']; ?>">
<br>
<br>
<input type="submit" value="Editar">
</form>