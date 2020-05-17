<?php 
include "controller.inc.php";


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
         <th scope='row'>".$r['id']."</th>
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
            echo "
         <td>
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

   public function GetDataPoint1()
   {
     $row = $this->DataPoint1();

     foreach($row as $r)
      {
        $arr = $r['Total_Paid'];
      }

      return $arr;
   }

   public function GetDataPoint2()
   {
     $row = $this->DataPoint2();

     foreach($row as $r)
      {
        $arr = $r['Total_Open'];
      }

      return $arr;
   }



}
?>
