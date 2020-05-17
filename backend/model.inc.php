<?php 
class db
{
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $db = "sgepj";

	public function db()
	{
		$db = mysqli_connect($this->host, $this->user, $this->password, $this->db) or die ("Error.");
		return $db;
	}

}


class users extends db
{
   //status 0 = not approved for usage 
   //status 1 = approved for usage 
   //type 1 = normal 
   //type 2 = admin	

	protected function InsertUser($username, $password)
	{   
		$db = $this->db();

		$username = mysqli_real_escape_string($db, $username);
		$password = mysqli_real_escape_string($db, $password);

		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$sql = "INSERT INTO users (username, password, type, status) VALUES ('$username', '$hashed_password', '1', '0') ";

		$execute = mysqli_query($db, $sql);		
	}

	protected function selectUser($username)
	{
		$db = $this->db();

		$username = mysqli_real_escape_string($db, $username);

		$sql = "SELECT* FROM users WHERE username = '$username' ";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		return $row;
	    endwhile;

	}

	protected function countUser($username)
		{
          $db = $this->db();
 
 		  $username = mysqli_real_escape_string($db, $username);
 
 		  $sql = "SELECT COUNT(*) as 'COUNT' FROM users WHERE username = '$username' ";
 
 		  $execute = mysqli_query($db, $sql);
 
 		  while($row = mysqli_fetch_assoc($execute)):
 		  return $row;
		  endwhile;	
		}	
}


class cli extends db
{
	protected function InsertClient($uniq_id, $cli_name, $cli_cnpj, $cli_password, $cli_total_debt, $cli_num_quota, $cli_contract)
	{
		$db = $this->db();

		$uniq_id = mysqli_real_escape_string($db, $uniq_id);
		$cli_name = mysqli_real_escape_string($db, $cli_name);
		$cli_cnpj = mysqli_real_escape_string($db, $cli_cnpj);
		$cli_password = mysqli_real_escape_string($db, $cli_password);
		$cli_total_debt = mysqli_real_escape_string($db, $cli_total_debt);
		$cli_num_quota = mysqli_real_escape_string($db, $cli_num_quota);
		$cli_contract = mysqli_real_escape_string($db, $cli_contract);

		$sql = " INSERT INTO client (uniq_id, name, cnpj, password, total_debt, num_quota, contract) VALUES ('$uniq_id', '$cli_name', '$cli_cnpj', '$cli_password', '$cli_total_debt', '$cli_num_quota', '$cli_contract')";

		$execute = mysqli_query($db, $sql);
	}

	protected function InsertQuota($cli_id, $cli_quota_value, $cli_line_quota)
	{
		$db = $this->db();

		$sql = "INSERT INTO quota (cli_id, quota_value, line_quota, status) VALUES ('$cli_id', '$cli_quota_value', '$cli_line_quota', '200') ";

		$execute = mysqli_query($db, $sql);
	}

	protected function SelectClientId($uniq_id)
	{
		$db = $this->db();

		$sql = "SELECT id FROM client WHERE uniq_id = '$uniq_id' ";

		$execute = mysqli_query($db, $sql);

		while($result = mysqli_fetch_assoc($execute)):
		return $result;
		endwhile;	
	}

	protected function SelectAllClients()
	{
		$db = $this->db();

		$sql = "SELECT* FROM client";

	   $execute = mysqli_query($db, $sql);

       while($row = mysqli_fetch_assoc($execute)):
       $data[] = array("id" => $row['id'], "name" =>  $row['name'], "cnpj" => $row['cnpj'], "total_debt" => $row['total_debt'], "num_quota" => $row['num_quota'], "contract" => $row['contract']);
       endwhile;
       return $data;
	}

	protected function SelectAllQuota($cli_id)
	{
		$db = $this->db();

		$sql = "SELECT* FROM quota WHERE cli_id = '$cli_id'";

		$execute = mysqli_query($db, $sql);

		while ($row = mysqli_fetch_assoc($execute)):
		$data[] = array("id" => $row['id'], "quota_value" => $row['quota_value'], "line_quota" => $row['line_quota'], "status" => $row['status']);
	    endwhile;
	    return $data;
	}

	protected function SelectOneQuota($quota_id)
	{
		$db = $this->db();

		$sql = "SELECT* FROM quota WHERE id = '$quota_id' ";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		$data[] = array("id" => $row['id'],"cli_id" => $row['cli_id'], "quota_value" => $row['quota_value'], "status" => $row['status']);
		endwhile;
		return $data;
	}

	protected function UpdateQuota($cli_id, $status, $quota_id)
	{
		$db = $this->db();

		$sql = "UPDATE quota SET status = '$status' WHERE id = '$quota_id' ";

		$execute = mysqli_query($db, $sql);

	}

	protected function DataPoint1()
	{
		$db = $this->db();

		$sql = "SELECT SUM(quota_value * 100 / q2.total) AS 'Total_Paid' FROM quota CROSS JOIN (SELECT SUM(quota_value) AS total FROM quota) q2 WHERE status = '100'";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		$data[] = array("Total_Paid" => $row['Total_Paid']);
		endwhile;
		return $data;
	}

	protected  function DataPoint2()
	{
		$db = $this->db();

		$sql = "SELECT SUM(quota_value * 100 / q2.total) AS 'Total_Open' FROM quota CROSS JOIN (SELECT SUM(quota_value) AS total FROM quota) q2 WHERE status = '200' OR status = '300';";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		$data[] = array("Total_Open" => $row['Total_Open']);
		endwhile;
		return $data;
	}

}
?>