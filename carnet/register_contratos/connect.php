<?php
//register

$db = mysqli_connect("localhost", "vrcred62_ROOT", "password", "vrcred62_carnet"); 
 session_start();

if(isset($_POST['register_btn'])){
  $contrato_CPF = mysqli_real_escape_string($db, $_POST['contrato_CPF']);
  $contrato_CNPJ = mysqli_real_escape_string($db, $_POST['contrato_CNPJ']);
  $numero_contrato = mysqli_real_escape_string($db, $_POST['numero_contrato']); 
  $contrato_pdf = mysqli_real_escape_string($db, $_POST['contrato_pdf']); 
  $sql = "INSERT INTO contratos(contrato_CPF, contrato_CNPJ, numero_contrato, contrato_pdf)  VALUES ('$contrato_CPF', '$contrato_CNPJ','$numero_contrato', '$contrato_pdf')";
  mysqli_query($db, $sql);
}


header("Location:index.html");   
 

  ?>


