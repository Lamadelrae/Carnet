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

    protected function SelectAllUsers()
	{
		$db = $this->db();

		$sql = "SELECT* FROM users WHERE status = 1";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		$data[] = array("id" => $row['id'], "username" => $row['username'], "type" => $row['type'], "status" => $row['status']);
		endwhile;
		return $data;
	}

	protected function SelectPendingUsers()
	{
		$db = $this->db();

		$sql = "SELECT* FROM users WHERE status = 0 ";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		$data[] = array("id" => $row['id'], "username" => $row['username'], "type" => $row['type'], "status" => $row['status']);
		endwhile;
		return $data;
	}

		protected function SelectOneUser($user_id)
	{
		$db = $this->db();

	    $user_id = mysqli_real_escape_string($db, $user_id);

		$sql = "SELECT* FROM users WHERE id = $user_id ";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		$data[] = array("id" => $row['id'], "username" => $row['username'], "type" => $row['type'], "status" => $row['status']);
		endwhile;
		return $data;
	}	

	protected function UpdateUser($user_id, $username, $password, $type, $status)
	{

		$db = $this->db();

		$user_id = mysqli_real_escape_string($db, $user_id);
		$username = mysqli_real_escape_string($db, $username);
		$password = mysqli_real_escape_string($db, $password);
		$type = mysqli_real_escape_string($db, $type);
		$status = mysqli_real_escape_string($db, $status);

		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "UPDATE users SET username = '$username', password = '$hashed_password', type = '$type', status = '$status' WHERE id = '$user_id' ";

		$execute = mysqli_query($db, $sql);
	}


   protected function UpdateUserNoPass($user_id, $username, $type, $status)
	{

		$db = $this->db();

		$user_id = mysqli_real_escape_string($db, $user_id);
		$username = mysqli_real_escape_string($db, $username);
		$type = mysqli_real_escape_string($db, $type);
		$status = mysqli_real_escape_string($db, $status);

		$sql = "UPDATE users SET username = '$username', type = '$type', status = '$status' WHERE id = '$user_id' ";

		$execute = mysqli_query($db, $sql);
	}

	protected function SelectUserType($user_id)
	{
		$db = $this->db();

		$sql = "SELECT type FROM users WHERE id = '$user_id' ";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		return $row;
		endwhile;	
	}

		protected function SelectUserStatus($user_id)
	{
		$db = $this->db();

		$sql = "SELECT status FROM users WHERE id = '$user_id' ";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		return $row;
		endwhile;	
	}

	protected function SelectUsername($user_id)
	{
		$db = $this->db();

		$sql = "SELECT username FROM users WHERE id = '$user_id' ";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		$data[] = array( "username" => $row['username']);
	    endwhile;
	    return $data;
	}

	protected function UpdateUsername($user_id, $username)
	{
		$db = $this->db();

		$username = mysqli_real_escape_string($db, $username);

		$sql = "UPDATE users SET username = '$username' WHERE id = '$user_id' ";

		$execute = mysqli_query($db, $sql);

	}

    protected function UpdatePassword($user_id, $password)
	{
		$db = $this->db();

		$password = mysqli_real_escape_string($db, $password);

		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "UPDATE users SET password = '$hashed_password' WHERE id = '$user_id' ";

		$execute = mysqli_query($db, $sql);

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
		$data[] = array("id" => $row['id'],"cli_id" => $row['cli_id'], "quota_value" => $row['quota_value'], "status" => $row['status'], "line_quota" => $row['line_quota']);
		endwhile;
		return $data;
	}

	protected function UpdateQuota($cli_id, $status, $quota_id)
	{
		$db = $this->db();

		$sql = "UPDATE quota SET status = '$status' WHERE id = '$quota_id' ";

		$execute = mysqli_query($db, $sql);

	}

    protected function TotalCli()
    {
    	$db = $this->db();

    	$sql = "SELECT COUNT(*) as 'COUNT' FROM client";

    	$result = mysqli_query($db, $sql);

    	while($row = mysqli_fetch_assoc($result)):
    	return $row;
        endwhile;
    }

    protected function TotalQuota()
    {
    	$db = $this->db();

    	$sql = "SELECT COUNT(*) as 'COUNT' FROM quota";

    	$result = mysqli_query($db, $sql);

    	while($row = mysqli_fetch_assoc($result)):
    	return $row;
        endwhile;
    }

    protected function TotalQuotaOpen()
    {
    	$db = $this->db();

    	$sql = "SELECT COUNT(*) as 'COUNT' FROM quota where status = 200";

    	$result = mysqli_query($db, $sql);

    	while($row = mysqli_fetch_assoc($result)):
    	return $row;
        endwhile;
    }

    protected function TotalQuotaClosed()
    {
    	$db = $this->db();

    	$sql = "SELECT COUNT(*) as 'COUNT' FROM quota where status = 100";

    	$result = mysqli_query($db, $sql);

    	while($row = mysqli_fetch_assoc($result)):
    	return $row;
        endwhile;
    }

    protected function ValueQuotaOpen()
    {
    	$db = $this->db();

    	$sql = "SELECT SUM(quota_value) as 'SUM' FROM quota where status = 200";

    	$result = mysqli_query($db, $sql);

    	while($row = mysqli_fetch_assoc($result)):
    	return $row;
        endwhile;
    }

    protected function ValueQuotaClosed()
    {
    	$db = $this->db();

    	$sql = "SELECT SUM(quota_value) as 'SUM' FROM quota where status = 100";

    	$result = mysqli_query($db, $sql);

    	while($row = mysqli_fetch_assoc($result)):
    	return $row;
        endwhile;
    }

    protected function TotalQuotaMora()
    {
    	$db = $this->db();

    	$sql = "SELECT COUNT(*) as 'COUNT' FROM quota where status = 300";

    	$result = mysqli_query($db, $sql);

    	while($row = mysqli_fetch_assoc($result)):
    	return $row;
        endwhile;
    }

    protected function ValueQuotaMora()
    {
    	$db = $this->db();

    	$sql = "SELECT SUM(quota_value) as 'SUM' FROM quota where status = 300";

    	$result = mysqli_query($db, $sql);

    	while($row = mysqli_fetch_assoc($result)):
    	return $row;
        endwhile;
    }

	protected function CountCli($cnpj)
	{
		$db  = $this->db();

		$cnpj = mysqli_real_escape_string($db, $cnpj);

		$sql = "SELECT COUNT(*) AS 'COUNT' FROM client WHERE cnpj = '$cnpj'";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		return $row;
		endwhile;
	}

	protected function SelectOneCli($cnpj)
	{
		$db = $this->db();

	    $cnpj = mysqli_real_escape_string($db, $cnpj);

		$sql = "SELECT* FROM client WHERE cnpj = '$cnpj' ";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		return $row;
		endwhile;

		return $row;
	}

	protected function SelectCliInfo($cli_id)
	{
		$db = $this->db();

	    $cli_id = mysqli_real_escape_string($db, $cli_id);

		$sql = "SELECT* FROM client WHERE id = '$cli_id' ";

		$execute = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($execute)):
		$data[] = array("id"=>$row['id'], "name"=>$row['name'], "cnpj"=>$row['cnpj'], "total_debt"=>$row['total_debt'], "num_quota"=>$row['num_quota'], "contract"=>$row['contract']);	
		endwhile;
		return $data;
	}

	protected function UpdateCliInfo($cli_id, $name, $password, $cnpj, $contract)
	{
		$db = $this->db();

		$cli_id = mysqli_real_escape_string($db, $cli_id);
		$name = mysqli_real_escape_string($db, $name);
		$password = mysqli_real_escape_string($db, $password);
		$cnpj = mysqli_real_escape_string($db, $cnpj);
		$contract = mysqli_real_escape_string($db, $contract);

		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "UPDATE client SET name = '$name', cnpj = '$cnpj', password = '$hashed_password', contract = '$contract' WHERE id = '$cli_id' ";

		$execute = mysqli_query($db, $sql); 

	}

	protected function UpdateCliInfoNoPass($cli_id, $name, $cnpj, $contract)
	{
		$db = $this->db();

		$cli_id = mysqli_real_escape_string($db, $cli_id);
		$name = mysqli_real_escape_string($db, $name);
		$cnpj = mysqli_real_escape_string($db, $cnpj);
		$contract = mysqli_real_escape_string($db, $contract);


		$sql = "UPDATE client SET name = '$name', cnpj = '$cnpj', contract = '$contract' WHERE id = '$cli_id' ";

		$execute = mysqli_query($db, $sql); 

	}

	protected function DeleteOldQuota($cli_id)
	{
		$db = $this->db();

		$cli_id = mysqli_real_escape_string($db, $cli_id);

		$sql = "DELETE FROM quota WHERE id = '$cli_id'";

		$execute = mysqli_query($db, $sql);
	}

	protected function UpdateCalcInfo($cli_id, $total_debt, $num_quota)
	{
		$db = $this->db();

		$cli_id = mysqli_real_escape_string($db, $cli_id);
		$total_debt = mysqli_real_escape_string($db, $total_debt);
		$num_quota = mysqli_real_escape_string($db, $num_quota);

		$sql = "UPDATE client SET ";
	}

}

class posts extends db
{
    protected function SelectPosts()
    {
    	$db = $this->db();

    	$sql = "SELECT posts.id as 'post_id', posts.title as 'post_title', posts.date as 'post_date', users.username as 'username' FROM posts JOIN users ON posts.user_id = users.id ";

    	$execute = mysqli_query($db, $sql);

    	while($row = mysqli_fetch_assoc($execute)):
    	$data[] = array("post_id" => $row['post_id'], "post_title" => $row['post_title'], "post_date" => $row['post_date'], "username" => $row['username']);
    	endwhile;
    	return $data;
    }

    protected function InsertPost($user_id, $title, $post)
    {
    	$db = $this->db();

    	$user_id = mysqli_real_escape_string($db, $user_id);
    	$title = mysqli_real_escape_string($db, $title);
    	$post = mysqli_real_escape_string($db, $post);

    	$date = gmdate("Y-m-d");

    	$sql = "INSERT INTO posts(user_id, title, post, date) VALUES ('$user_id', '$title', '$post', '$date')";

    	$execute = mysqli_query($db, $sql);
    }

    protected function UpdatePost($post_id, $title, $post)
    {
    	$db = $this->db();

    	$sql = "UPDATE posts SET title = '$title', post = '$post' WHERE id = '$post_id' ";

    	$execute = mysqli_query($db, $sql);
    }

    protected function SelectPostById($post_id)
    {
    	$db = $this->db();

    	$sql = "SELECT* FROM posts WHERE id = '$post_id'";

    	$execute = mysqli_query($db, $sql);

    	while($row = mysqli_fetch_assoc($execute)):
        $data[] = array("id" => $row['id'], "title" => $row['title'], "post" => $row['post']);
    	endwhile;
    	return $data;
    }

    protected function SelectPostsForNews()
    {
    	$db = $this->db();

    	$sql = "SELECT posts.id as 'post_id', posts.title as 'post_title', posts.post as 'post',posts.date as 'post_date', users.username as 'username' FROM posts JOIN users ON posts.user_id = users.id order by post_id desc";

    	$execute = mysqli_query($db, $sql);


    	while($row = mysqli_fetch_assoc($execute)):
    	$data[] = array("post_id" => $row['post_id'], "post_title" => $row['post_title'], "post" => $row['post'], "post_date" => $row['post_date'], "username" => $row['username']);
    	endwhile;
    	return $data;
    }
}

?>