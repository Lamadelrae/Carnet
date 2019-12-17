<!DOCTYPE html>
<html>

  <head>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
    <?php  error_reporting(E_ERROR | E_WARNING | E_PARSE);
           $cnpj = $_GET['cadastro'];
           $db = mysqli_connect("localhost", "root", "", "carnet"); 
           $result = mysqli_query($db, "SELECT*  FROM users JOIN status ON users.cnpj = status.cnpj WHERE status.cnpj = '$cnpj'") or die ("Error while connecting".mysqli_error($db));  
           $result2 = mysqli_query($db, "SELECT* FROM users WHERE cnpj = '$cnpj' ");   
           $primeira_parcela_num = 1;
           ?>
           <title>Cadastro <?php echo $cnpj; ?></title>
</head>

 <body style="background-color:#A0A0A0;">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="SuperUsuario.php">Voltar</a>
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
<div style="background-color:#DCDCDC;" class="container">
  <h2>Parcelas</h2>
  <p>Aqui você visualiza as parcelas de cada cliente e o valor.</p>   
    <?php while ($row2 = $result2->fetch_assoc()): ?>
    <p>Link Boleto: <a><?php echo $row2["boleto"]?></a> </p>
    <a href="edit_boleto.php?cnpj=<?php echo $row2['cnpj']?>& boleto=<?php echo $row2['boleto']; ?> "  class="btn btn-success" name="save" id="save"> Editar </a>
    <?php endwhile; ?>

  <table class="table table-borderless">
    <thead>
      <tr>
        <th>Parcela Número</th>
        <th>Valor Parcela</th>
        <th>Status</th>
        <th>Editar Status</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): 
           $num = $row["parcelas"];
           $valor_total_parcelas = $row["valor_total_parcelas"];
           $somente_uma_parcela = ($valor_total_parcelas * 1000 / $num );
           $Parcela_Status = $row["Parcela_Status"];
           $id_parcela = $row["id_parcela"];
  ?>
  <tr>
  <td> <?php echo $primeira_parcela_num++; ?> </td>
  <td> <?php echo round ($somente_uma_parcela); ?> </td>
  <td> <?php echo $Parcela_Status  ?> </td> 
  <form action="edit.php">
  <td><a target="_blank" href="edit.php?edit=<?php echo $row['id_parcela']?>"   class="btn btn-success" name="save" id="save">Editar</a></td>
  </form>
</tr>
 </tbody>
       <?php endwhile; ?>
  </table>
</div>
 </body>
</html>