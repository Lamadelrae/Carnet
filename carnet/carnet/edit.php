<?php

    include "CadastroCliente.php";

	$db = mysqli_connect("localhost", "root", "", "carnet"); 
    
	if( isset($_GET['edit']) )
	{
		$id = $_GET['edit'];
		$sql= mysqli_query($db, "SELECT * FROM status WHERE id_parcela='$id'");
		$row= mysqli_fetch_array($sql);
	}
 
	if( isset($_POST['status']) )
	{
		$newstatus = $_POST['status'];
		$id  = $_POST['id'];
		$sql2  = "UPDATE status SET Parcela_Status='$newstatus' WHERE id_parcela='$id'";
		$result = mysqli_query($db, $sql2) or die("Could not update".mysqli_error($db));
	 header("Location: SuperUsuario.php");
	}

 
?>

<form  class ="container" action="edit.php" method="POST">
ID PARCELA BD: 	<?php echo $row['id_parcela']; ?>
  <br>
Status:
   <input type="text" name="status" id="status" value="<?php echo $row['Parcela_Status']; ?>">
   <input type="hidden" name="id" id="id" value="<?php echo $row['id_parcela']; ?>">
  <br>
  <br>
<input type="submit" value="Editar">
</form>