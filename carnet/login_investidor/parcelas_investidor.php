<?php  
 $cnpj = $_GET["cnpj"];
 $cpf = $_GET['cpf'];
 $db = mysqli_connect("localhost", "root", "", "carnet");
?>
<!DOCTYPE html>
<head> 
   <link rel="stylesheet" href="css/style_table.css">
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
        <b><a href="#" style="color:white">  Usuário Ativo: <?php echo $cpf;?></a></b>
        </span>
  </div>
</nav>
<?php 
$sql = "SELECT* FROM users JOIN status ON users.cnpj = status.cnpj JOIN contratos ON status.cnpj = contratos.contrato_CNPJ WHERE contrato_CPF = '$cpf' AND contrato_CNPJ = '$cnpj' ";
$result = mysqli_query($db, $sql) or die ("bad query");
$primeira_parcela_num = 1;
?>

<body style="background-color:#ffbb38;">
<div class="container">
<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Parcela Número</th>
      <th scope="col">Valor Parcelas</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
    <?php while ($row = $result->fetch_assoc()): ?>
  <tbody>
    <tr>
      <td><?php echo $primeira_parcela_num++ ?></td>
      <td><?php echo $row["Parcela_Valor"]; ?></td>
      <td><?php echo $row["Parcela_Status"]; ?></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
  <?php endwhile; ?>
</table>
</div>
</body>