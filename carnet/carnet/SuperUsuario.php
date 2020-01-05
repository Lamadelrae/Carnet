<!DOCTYPE html>
<html>
<head>

<title>Tela do Usuário Supremo</title> 
  <link rel="stylesheet" href="css/style_nav.css">
  <link rel="stylesheet" href="css/style_table.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <?php   $db = mysqli_connect("localhost", "root", "", "carnet"); 
           $result = $db->query("SELECT* FROM users") or die ("Bad Query");

   ?>

</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="SuperUsuario.php">Home</a>
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


<body style="background-color:#A0A0A0;"> 
<br>

<div style="background-color:#DCDCDC;" class="container">
  <h2>Clientes</h2>         
  <table class="table table-borderless">
    <thead>
      <tr>
        <th>CNPJ</th>
        <th>Valor Total Parcelas</th>
        <th>Parcelas</th>
        <th>Senha</th>
        <th>Numéro do contrato</th>
        <th></th>
      </tr>
    </thead>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tbody>
      <tr>
        <td><?php echo $row['cnpj']; ?></td>
        <td><?php echo $row['valor_total_parcelas']; ?></td>
        <td><?php echo $row['parcelas']; ?></td>
        <td><?php echo $row['password']; ?></td>
        <td><?php echo $row['numero_contrato']; ?></td>
        <td><a class="btn btn-danger" target="_blank" href="cadastrocliente.php?cadastro=<?php echo $row['cnpj']; ?>">Cadastro</a></td>
      </tr>
     <?php endwhile; ?>
    </tbody>
  </table>
</div>


<?php    $db2 = mysqli_connect("localhost", "root", "", "carnet"); 
         $result2 = $db2->query("SELECT* FROM user_investidor") or die ("Bad Query");


?>

<div style="background-color:#DCDCDC;" class="container">
  <h2>Investidores</h2>         
  <table class="table table-borderless">
    <thead>
      <tr>
        <th>CPF</th>
        <th>Senha</th>
        <th></th>
      </tr>
    </thead>

    <?php while ($row2 = $result2->fetch_assoc()): ?>
    <tbody>
      <tr>
         <td><?php echo $row2['cpf']; ?></td>
         <td><?php echo $row2['password']; ?></td>
         <td><a class="btn btn-danger" target="_blank" href="contratos_investidor.php?cpf=<?php echo $row2['cpf']; ?>">Contratos</a></td>
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
  <script src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
  <script src="js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript" /></script>
</html>





