<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
session_start();
include "../frameworks/navbar.inc.php";
include "../backend/view.inc.php";

$username = $_SESSION['username'];
$validatesesh = new usersController();
$validatesesh->validatesesh($username);?>
<br>
<br>
<br>
<br>
<!DOCTYPE html>
<html>
<head>
	<title>CRM</title>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<form method="post" action="">
				<input type="text" class="form-control" id="cli_name" name="cli_name" placeholder="Nome do cliente">
				<br>
				<input type="text" class="form-control" id="cli_cnpj" name="cli_cnpj" placeholder="CNPJ do cliente">
				<br>
				<input type="password" class="form-control" id="cli_password" name="cli_password" placeholder="Senha do cliente (poderá ser redefinida)">
				<br>
				<input type="text" class="form-control" id="cli_total_debt" name="cli_total_debt" placeholder="Valor total da Dívida">
				<br>
				<input type="number" class="form-control" id="cli_num_quota" name="cli_num_quota" placeholder="Quantidade de parcelas">
				<br>
				<input type="text" class="form-control" id="cli_contract" name="cli_contract" placeholder="Contrato">
				<br>
				<button type="submit" id="submitbtn" name="submitbtn" class="btn btn-success"> Gerar Cliente <i class="fas fa-plus"></i></button>
			</form>
		</div>
		<div class="col"></div>
	</div>	
</div>
</body>
</html>

<script src="../frameworks/jquery.mask.js"></script>

<script type="text/javascript">
 $(document).ready(function(){
  $('#cli_total_debt').mask("#.##0,00", {reverse: true});
  $('#cli_cnpj').mask('00.000.000/0000-00', {reverse: true});
   });
</script>

<?php 

if(isset($_POST['submitbtn']))
{
    $cli_name = $_POST['cli_name'];
    $cli_cnpj = $_POST['cli_cnpj'];
    $cli_password = $_POST['cli_password'];

    $cli_total_debt_0 =  str_replace(".", "", $_POST['cli_total_debt'] );
    $cli_total_debt = str_replace(",", ".", $cli_total_debt_0 );
    
    $cli_num_quota = $_POST['cli_num_quota'];
    $cli_contract = $_POST['cli_contract'];
    $uniq_id = uniqid();
	$RegisterClient = new cliController();

	$RegisterClient->RegisterClient($uniq_id, $cli_name, $cli_cnpj, $cli_password, $cli_total_debt, $cli_num_quota, $cli_contract);

}

?>
