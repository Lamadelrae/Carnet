<?php
  error_reporting(E_ERROR | E_WARNING | E_PARSE);

  $db = mysqli_connect("localhost", "root", "", "carnet");

  $cpf = $_POST['cpf'];
  $password = $_POST['password'];

  $cpf = stripcslashes($cpf);
  $password = stripcslashes($password);
  $cpf = mysqli_real_escape_string($db,$cpf);
  $password = mysqli_real_escape_string($db, $password);
  $result = mysqli_query($db, "SELECT* FROM user_investidor WHERE cpf = '$cpf' AND password = '$password'") or die ("Error while connecting".mysqli_error($db));
  $row = mysqli_fetch_array($result);

if($row['cpf']== $cpf && $row['password'] == $password){
}

else{
  echo "Usuário ou senha incorretas";
  return false; 
}

?>
<!DOCTYPE html>
<head>   
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Investidor <?php echo $cpf ?></title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
        <b><a href="#" style="color:white">  Usuário Ativo: <?php echo $row["cpf"];?></a></b>
        </span>
  </div>
</nav>

<?php 
 $result2 = mysqli_query($db, "SELECT* FROM contratos WHERE contrato_CPF = '$cpf' ") or die ("Error while connecting".mysqli_error($db));
?>
<body style="background-color:#A0A0A0;">
  <div style="background-color:#DCDCDC;"class="container">
  <h2>Contratos do investidor: <?php echo $cpf?></h2>         
  <table class="table table-borderless">
    <thead>
      <tr>
        <th>Número do contrato</th>
        <th>PDF do contrato</th>
      </tr>
    </thead>
    <?php while ($row2 = $result2->fetch_assoc()): ?>
    <tbody>
      <tr>
      <td><?php echo $row2['numero_contrato']; ?></td>
      <td><?php echo $row2['contrato_pdf']; ?></td>
      <td><a class="btn btn-danger" href="parcelas_investidor.php?cpf=<?php echo $row2["contrato_CPF"]?>&cnpj=<?php echo $row2["contrato_CNPJ"];?>" target="_blank">Parcelas Do contrato</a></td>
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
