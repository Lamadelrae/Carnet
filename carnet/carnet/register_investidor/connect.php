<?php
//register

$db = mysqli_connect("localhost", "root", "", "carnet");
 session_start();

if(isset($_POST['register_btn'])){
  $cpf = mysqli_real_escape_string($db, $_POST['cpf']); 
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $sql = "INSERT INTO user_investidor(cpf, password)  VALUES ('$cpf', '$password')";
  mysqli_query($db, $sql);
}

header("Location:index.html");   
 

  ?>


