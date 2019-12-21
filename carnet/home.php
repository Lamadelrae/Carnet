<?php
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
  $db = mysqli_connect("localhost", "root", "", "carnet");

  $cnpj = $_POST['cnpj'];
  $password = $_POST['password'];
  $cnpj2 = "00.000.000/0000-01";
  $cnpj = stripcslashes( $cnpj);
  $password = stripcslashes($password);
  $cnpj = mysqli_real_escape_string($db,$cnpj);
  $password = mysqli_real_escape_string($db, $password);
  $result = mysqli_query($db, "select* from users where cnpj = '$cnpj' and password = '$password'") or die ("Error while connecting".mysqli_error($db));
  $row = mysqli_fetch_array($result);

 if ($row['cnpj']== $cnpj2){
  header("location:SuperUsuario.php");
}
else {

if($row['cnpj']== $cnpj && $row['password'] == $password){

}
else{
	echo "Usuário ou senha incorretas";
	return false; 
}

}

?>
<!DOCTYPE html>
<head>   
   <link rel="stylesheet" href="css/style_table.css">
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Usuário: <?php echo $row["cnpj"]?></title>
    
</head>

<body style="background-color:#ffbb38">
  <?php

//SELECT FOR ACTIVE USER 
$sql2 = "SELECT* FROM users WHERE cnpj = '$cnpj'";
$result2 = mysqli_query($db, $sql2) or die ("bad query");
  ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <?php while ($row2 = $result2->fetch_assoc()): ?>
  <a class="navbar-brand" href="#">Home</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"> </span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="https://vrcredito.com/VRCREDITO/home.html" target="_blank">Nosso Site </a>
      </li>
       <li class="nav-item">
        <a style="color:red;" class="nav-link" href="index.html">LOG OFF</a>
      </li>
      </ul>
      </div>

      <div class="float-left">
        <span class="navbar-text">
        <b>
          <a href="#" style="color:white">  Usuário Ativo: <?php echo $row2["cnpj"]?> || </a>
        </b>
        </span>
     <span class="navbar-text">
       <b>
        <a href="#" style="color:white"> Parcelas: <?php echo $row2["parcelas"]?> ||</a> 
       </b>
     </span>
    <span class="navbar-text">
    <b>  
      <a href="#" style="color:white"> Valor total a pagar: R$<?php echo $row2["valor_total_parcelas"]?> </a> 
    </b>
    </span>
    </div>
  <?php endwhile; ?>
</nav>


    <div class="container">
   <span class="navbar-text">
    <h5>  Prezado usuário, Juros, e outras alterações em relação ao valor do empréstimo, não é representado nesta tela. </h5>
    <a class="btn btn-success" href="<?php echo $row["boleto"] ?>" target="_blank">BOLETO</a>
    </span>
  </div>

  <?php 
//SELECT FOR TABLE
$db = mysqli_connect("localhost", "root", "", "carnet");
 session_start();
$sql = " SELECT*  FROM users INNER JOIN status ON users.cnpj = status.cnpj WHERE status.cnpj = '$cnpj' ";
$result = mysqli_query($db, $sql) or die ("bad query");
$num = $row["parcelas"];
$cnpj = $row["cnpj"];
$valor_total_parcelas = $row["valor_total_parcelas"];
$somente_uma_parcela = ($valor_total_parcelas *1000 / $num );
$Parcela_Status = $row["Parcela_Status"];
$primeira_parcela_num = 1;

?>

<div class="container">
<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Parcela Número</th>
      <th scope="col">Valor Parcelas</th>
      <th scope="col">Status</th>
    </tr>
  </thead>

  <tbody>
     <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $primeira_parcela_num++ ?></td>
        <td><?php echo round ($somente_uma_parcela) ?></td>
        <td><?php echo $row["Parcela_Status"]; ?></td>
    </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
     <?php endwhile; ?>
  </tbody>
  </table>
</div>
</body>


 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>