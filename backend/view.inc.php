<?php 
include "controller.inc.php";

class usersView extends usersController
{
  public function user_requests()
  {

    $row = $this->SelectAllUsers();
    $rowP = $this->SelectPendingUsers();

    echo "
 <div class='container'>   
  <div class='row'>
    <div class='col'>
      <h2>Todos os usuários Autorizados</h2>
    <table class='table'>
       <thead class='thead-dark'>
         <tr>
           <th scope='col'>ID</th>
           <th scope='col'>UserName</th>
           <th scope='col'>UserType</th>
           <th scope='col'>Botões</th>
          </tr>
      </thead>
        <tbody>";
      foreach ($row as $r ) 
        {
        echo "
          <tr>
            <th scope='row'>".$r['id']."</th>
            <td>".$r['username']."</td>
            <td>".$r['type']."</td>
            <td><a class='btn btn-success' href='edit_user.php?user_id=".$r['id']."'><i class='fas fa-edit'></i> Editar</a></td>
          </tr>";
        }
     echo "
        </tbody>
    </table>
    </div>
    <div class='col col-lg-4'>
     <h2>Usuários Pendentes</h2>
     <table class='table'>
       <thead class='thead-dark'>
         <tr>
           <th scope='col'>UserName</th>
           <th scope='col'>Botões</th>
         </tr>
       </thead>
        <tbody>";
      foreach($rowP as $rP)
      {  
       echo " 
          <tr>
            <th scope='row'>".$rP['username']."</th>
            <td><a class='btn btn-success' href='edit_user.php?user_id=".$rP['id']."'><i class='fas fa-edit'></i> Editar</a></td>
          </tr>";
        }
        echo "  
         </tbody>
      </table>
    </div>
  </div>
</div> ";
  }

  public function edit_user($user_id)
  {
     $row = $this->SelectOneUser($user_id);  
     foreach($row as $r)
     {
         echo "<br>\n<br>\n<br>\n<br>\n<br>\n<br>\n<br>\n<div class='container'>\n<div class='row'>\n<div class='col'></div>\n<div class='col'>\n<div class='card bg-light mb-3' style='width: 25rem;'>\n<div class='card-header'>Editar Informações do Usuário: <b>".$r['username']."</b></div>\n<div class='card-body'>\n<form method='post'>\n<input required class='form-control' name='username' id='username' placeholder='Username' value='".$r['username']."'>\n<br>\n<input required type='password' class='form-control' name='password' id='password' placeholder='Senha'>\n<br>Permissão:\n<input hidden checked type='radio' name='type' id='type' value='".$r['type']."'> \n<input type='radio' name='type' id='type' value='1'> Super Admin \n<input type='radio' name='type' id='type' value='2'> Usuário Normal\n<br>\n<br>Autorização:\n<input hidden checked type='radio' name='status' id='status' value='".$r['status']."'> \n<input type='radio' name='status' id='status' value='0'> <b style='color:red;'>Desautorizar</b>\n<input type='radio' name='status' id='status' value='1'> <b style='color:green;'>Autorizar</b>\n<br>\n<br>\n<button id='submitbtn' name='submitbtn' class='btn btn-success' type='submit'>Gravar</button>\n</form>\n</div>\n</div> \n</div>\n<div class='col'></div>\n</div> \n</div>";

       }

       if(isset($_POST['submitbtn']))
       {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['type'];
        $status = $_POST['status'];

        $this->ModifyUser($user_id, $username, $password, $type, $status);
       }
  }

}

class cliView extends cliController 
{
	public function AllCliTable()
	{
		$row = $this->SelectAllClients();

		echo "<div class='container'>	
               <table class='table'>
                <thead>
                  <tr>
                    <th scope=''>#</th>
                    <th scope='col'>Nome</th>
                    <th scope='col'>CNPJ</th>
                    <th scope='col'>Dívida Total</th>
                    <th scope='col'>N° Parcelas</th>
                    <th scope='col'>Contrato</th>
                  </tr>
                </thead>
                <tbody>";
                
		foreach ($row as $r)
		{
		     echo "
                  <tr>
                   <th></i><a style='color:red;' href='/projects/sgepj/cli/quota.php?cli_id=".$r['id']."'>#".$r['id']." <i class='fas fa-arrow-right'> </a></th>
                    <td>".$r['name']."</td>
                    <td>".$r['cnpj']."</td>
                    <td>".$r['total_debt']."</td>
                    <td>".$r['num_quota']."</td>
                    <td>".$r['contract']."</td>
                  </tr> 
		";
		}

		echo "  </tbody>
              </table>
            </div>";
	}

	public function CliQuota($cli_id)
	{
    $cli_id = mysqli_real_escape_string($this->db(), $cli_id);

		$row = $this->SelectAllQuota($cli_id);

		echo "<div class='container'>	
             <table class='table'>
              <thead>
                <tr>
                  <th scope=''>#</th>
                  <th scope='col'>Parcela Valor</th>
                  <th scope='col'>Status Atual</th>
                  <th scope='col'>Editar</th>       
                </tr>
              </thead>
              <tbody>";
        foreach ($row as $r) 
        {

        	echo "
        	<tr>
        	  <th>".$r['line_quota']."</th>
        	  <td>".$r['quota_value']."</td>";
        	 if($r['status'] == 100)
        	 {
        	 	echo "<td style='color:#5cb85c;'><b>Pago</b></td>";
        	 } 
        	 elseif ($r['status'] == 200 ) 
        	 {
        	 	echo "<td style='color:#f0ad4e;'><b>Pendente</b></td>";
        	 }
        	 elseif ($r['status'] == 300)
        	 {
        	 	echo "<td style='color:#d9534f;'><b>Mora</b></td>";
        	 }
           echo "<td><a href='edit_quota.php?quota_id=".$r['id']." ' style='color:white;' class='btn btn-success'><i class='fas fa-edit'></i></a></td>";
        }
     echo "</tbody>
         </table>
       </div>";
	}

  public function CliOneQuota($quota_id)
  {
   $quota_id = mysqli_real_escape_string($this->db(), $quota_id);

   $row = $this->SelectOneQuota($quota_id);

   echo "
  <div class='container'> 
    <table class='table'>
      <thead>
        <tr>
          <th scope='col'>#</th>
          <th scope='col'>Parcela Valor</th>
          <th scope='col'>Parcela Status Atual</th>
          <th scope='col'>Opções</th>
          <th scope='col'></th>
          <th scope='col'></th>
        </tr>
      </thead>";

      foreach ($row as $r)
      {

       echo "
     <tbody>  
      <tr>
         <th scope='row'>".$r['line_quota']."</th>
         <td>".$r['quota_value']."</td>";
          if($r['status'] == 100)
           {
            echo "<td style='color:#5cb85c;'><b>Pago</b></td>";
           } 
           elseif ($r['status'] == 200 ) 
           {
            echo "<td style='color:#f0ad4e;'><b>Pendente</b></td>";
           }
           elseif ($r['status'] == 300)
           {
            echo "<td style='color:#d9534f;'><b>Mora</b></td>";
           }
            echo "<td>
            <form method='post' enctype='multipart/form-data'>
              <input hidden checked type='radio' class='form-check-input' name='status' value='".$r['status']."'>
              <input type='radio' class='form-check-input' name='status' value='100'><b><p style='color:#5cb85c;'>Pago</p></b>
              <input type='radio' class='form-check-input' name='status' value='200'><b><p style='color:#f0ad4e;'>Pendente</p></b>
              <input type='radio' class='form-check-input' name='status' value='300'><b><p style='color:#d9534f;'>Mora</p></b> 
         </td>
         <td><input accept='image/*,.pdf' id='file' name='file'  type='file' value='PDF'></td>
         <td><input id='submit' name='submit' class='btn btn-success' type='submit' value='Gravar'></td>
         <td><input id='setPDF' name='setPDF' class='btn btn-success' type='submit' value='Gravar PDF'></td>
         </form>
      </tr>
   </tbody>"; 
       $cli_id = $r['cli_id'];
      }
      
      echo "</table>
              </div>";

   if(isset($_POST['submit']))
     {
      $status = $_POST['status'];
      $this->setQuota($cli_id, $status, $quota_id);
     }

     if(isset($_POST['setPDF']))
     {
        $file = $_POST['file'];
        $this->setPDF($file, $cli_id, $quota_id);
     }
     echo "<div class='container'><iframe src='pdf/cli_".$cli_id."/quota_".$quota_id.".pdf' style='width:600px; height:500px;' frameborder='0'></iframe></div>";
   }

   public function Tiles()
   {

    $totalCli = $this->TotalCli();
    $totalQuota = $this->TotalQuota();
    $totalQuotaOpen = $this->TotalQuotaOpen();
    $totalQuotaClosed = $this->TotalQuotaClosed();
    $totalQuotaMora = $this->TotalQuotaMora();

    $valueQuotaOpen = $this->ValueQuotaOpen();
    $valueQuotaClosed = $this->ValueQuotaClosed();
    $valueQuotaMora = $this->ValueQuotaMora();

    echo "<div class='container float-left'>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class='row'>
               <div class='col' name='CliTotal'>
                   <div class='card bg-light mb-3' style='max-width: 18rem;''>
                     <div class='card-header'>Total De Clientes</div>
                       <div class='card-body'>
                      <h1 class='card-text'>".$totalCli['COUNT']."</h1>
                    </div>
                  </div>
               </div>
               <div class='col' name='TotalQuota'>
               <div class='card bg-light mb-3' style='max-width: 18rem;''>
                     <div class='card-header'>Total de Parcelas</div>
                       <div class='card-body'>
                      <h1 class='card-text'>".$totalQuota['COUNT']."</h1>
                    </div>
                  </div>
               </div>
               <div class='col' name='TotalOpenQuota'>
               <div class='card bg-light mb-3' style='max-width: 18rem;''>
                     <div class='card-header'>Total de Parcelas em Abertas</div>
                       <div class='card-body'>
                      <h1 style='color:#f0ad4e';  class='card-text'>".$totalQuotaOpen['COUNT']."</h1>
                    </div>
                  </div>
               </div>
               <div class='col' name='TotalClosedQuota'>
               <div class='card bg-light mb-3' style='max-width: 18rem;''>
                     <div class='card-header'>Total de parcelas Fechadas</div>
                       <div class='card-body'>
                      <h1 style='color:#5cb85c'; class='card-text'>".$totalQuotaClosed['COUNT']."</h1>
                    </div>
                  </div>
               </div>
            </div>
            <br>
            <br>
            <br>
            <br>
              <div class='row'>
               <div class='col' name='CliTotal'>
                   <div class='card bg-light mb-3' style='max-width: 18rem;''>
                     <div class='card-header'>Valor de Parcelas em aberta</div>
                       <div class='card-body'>
                      <h1 style='color:#f0ad4e';  class='card-text'>".$valueQuotaOpen['SUM']."</h1>
                    </div>
                  </div>
               </div>
               <div class='col' name='TotalQuota'>
               <div class='card bg-light mb-3' style='max-width: 18rem;''>
                     <div class='card-header'>Valor de parcelas Fechadas</div>
                       <div class='card-body'>
                      <h1 style='color:#5cb85c'; class='card-text'>".$valueQuotaClosed['SUM']."</h1>
                    </div>
                  </div>
               </div>
               <div class='col' name='TotalOpenQuota'>
               <div class='card bg-light mb-3' style='max-width: 18rem;''>
                     <div class='card-header'>Total de parcelas em Mora</div>
                       <div class='card-body'>
                      <h1 style='color:#d9534f'; class='card-text'>".$totalQuotaMora['COUNT']."</h1>
                    </div>
                  </div>
               </div>
               <div class='col' name='TotalClosedQuota'>
               <div class='card bg-light mb-3' style='max-width: 18rem;''>
                     <div class='card-header'>Valor de parcelas em Mora</div>
                       <div class='card-body'>
                      <h1 style='color:#d9534f'; class='card-text'>".$valueQuotaMora['SUM']."</h1>
                    </div>
                  </div>
               </div>
            </div>
          </div>";
   }

   public function News()
   {
    echo "<br>
          <br>
          <br>
          <div class='float-right'>
            <iframe width='600' height='800' src='news/news.php'></iframe> 
          </div>";
   }

  public function CliQuotaCliArea($cli_id)
  {
    $cli_id = mysqli_real_escape_string($this->db(), $cli_id);

    $row = $this->SelectAllQuota($cli_id);

    echo "<div class='container'> 
             <table class='table'>
              <thead>
                <tr>
                  <th scope=''>#</th>
                  <th scope='col'>Parcela Valor</th>
                  <th scope='col'>Status Atual</th>
                  <th scope='col'>Boleto</th>       
                </tr>
              </thead>
              <tbody>";
        foreach ($row as $r) 
        {

          echo "
          <tr>
            <th>".$r['line_quota']."</th>
            <td>".$r['quota_value']."</td>";
           if($r['status'] == 100)
           {
            echo "<td style='color:#5cb85c;'><b>Pago</b></td>";
           } 
           elseif ($r['status'] == 200 ) 
           {
            echo "<td style='color:#f0ad4e;'><b>Pendente</b></td>";
           }
           elseif ($r['status'] == 300)
           {
            echo "<td style='color:#d9534f;'><b>Mora</b></td>";
           }
           echo "<td><a class='btn btn-success' href='/projects/SGEPJ/cli/pdf/cli_".$cli_id."/quota_".$r['id'].".pdf '>Boleto</a>";
        }
     echo "</tbody>
         </table>
       </div>";
  }

}

class postsView extends postsController 
{
  public function GetAllPosts($user_id)
  {
  $row = $this->SelectPosts();
  echo "<br>
  <br>
  <br>
  <div class='container'> 
   <div class='row'>
   <div class='col'>
   <h3>Criar Novo Post</h3>
   <form method='post'>
     <input required class='form-control' id='title' name='title' placeholder='Título do post'>
     <br>
     <textarea required style='height:300px;' id='post' name='post' class='form-control' placeholder='Digite o post aqui...'></textarea>
     <br>
     <button id='submitbtn' name='submitbtn' class='btn btn-success' type='submit'><i class='far fa-plus-square'></i> Postar </button>
   </form>
   </div>
    <div class='col'> 
    <table class='table'>
      <thead>
      <h3>Histórico de posts</h3>
        <tr>
          <th scope='col'>POST ID</th>
          <th scope='col'>Título</th>
          <th scope='col'>Quem Fez o post</th>
          <th scope='col'>Data Feita</th>
        </tr>
      </thead>
      <tbody>";
     foreach ($row as $r)
     {
      $original_date = $r['post_date'];
      $timestamp = strtotime($original_date);
      $new_date = date("d/m/Y", $timestamp);
        echo "<tr>
          <th scope='row'><a style='color:green;' href='edit_post.php?post_id=".$r['post_id']."'>".$r['post_id']." <i class='fas fa-arrow-right'></i></th>
          <td>".$r['post_title']."</td>
          <td>".$r['username']."</td>
          <td>".$new_date."</td>
         </tr>";
      }
    echo "</tbody>
      </table>
     </div> 
    </div>  
  </div>  ";

  if(isset($_POST['submitbtn']))
  {
    $title = $_POST['title'];
    $post = $_POST['post'];

    $this->SetPost($user_id, $title, $post);
  }

  }


  public function ViewPost($post_id)
  {
   $row = $this->SelectPostById($post_id);
   
   foreach ($row as $r) 
    {
    echo "
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
<div class='container'>
 <div class='row'>
  <div class='col'></div>
  <div class='col'>
       <form method='post'>
           <div class='card bg-light mb-3' style='width: 30rem;'>
            <div class='card-header'> <b>Editar post N°".$r['id']."</b></div>
            <div class='card-body'>
            <h6 class='card-title'>Título: <input required class='form-control' name='title' value='".$r['title']."'></h6>
            <textarea required id='post' name='post' style='height:250;' class='form-control'>".$r['post']."</textarea> 
            <br>
            <br>
            <button class='btn btn-success' type='submit' name='submitbtn' id='submitbtn'>Gravar</button>
          </div>
         </div>
      </form>  
   </div>
    <div class='col'></div> 
   </div>   
 </div>";
    }

    if(isset($_POST['submitbtn']))
    {
      $title = $_POST['title'];
      $post = $_POST['post'];

      $this->EditPost($post_id, $title, $post);
    } 
  }

  public function ViewAllPosts()
  {
    $row = $this->SelectPostsForNews();
  foreach($row as $r)
  {  
    echo "
    <div class='container'>
 <table class='table'>
  <thead class='thead-dark'>
    <tr>
      <th scope='col'> Título: ".$r['post_title']."<div class='float-right'>Feito por: ".$r['username']."</div></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope='row'><textarea style='height:200px;' readonly class='form-control'>".$r['post']."</textarea></th>
    </tr>
  </tbody>
</table>
</div>";
}
  }
}
?>
