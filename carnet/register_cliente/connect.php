<?php
//register

$db = mysqli_connect("localhost", "vrcred62_ROOT", "password", "vrcred62_carnet"); 
 session_start();

if(isset($_POST['register_btn'])){
  $cnpj = mysqli_real_escape_string($db, $_POST['cnpj']); 
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $parcelas = mysqli_real_escape_string($db, $_POST['parcelas']);
  $valor_total_parcelas = mysqli_real_escape_string($db, $_POST['valor_total_parcelas']);
  $boleto = mysqli_real_escape_string($db, $_POST['boleto']);
  $numero_contrato = mysqli_real_escape_string($db, $_POST['numero_contrato']);
  
  $sql = "INSERT INTO users(cnpj, password, parcelas, valor_total_parcelas, boleto, numero_contrato)  VALUES ('$cnpj', '$password', '$parcelas', '$valor_total_parcelas', '$boleto', '$numero_contrato')";
  mysqli_query($db, $sql);

$db2 = mysqli_connect("localhost", "vrcred62_ROOT", "password", "vrcred62_carnet"); 
$Parcela_Valor = ($valor_total_parcelas * 1000 / $parcelas);
$status = ("Pendente");
$sql2 = "INSERT INTO status(Parcela_Valor, Parcela_Status, cnpj)  VALUES ('$Parcela_Valor', '$status', '$cnpj')";

for ($x = 1; $x <= $parcelas; $x++){
     mysqli_query($db2, $sql2);

     }
}

header("Location:index.html");   
 

  ?>


