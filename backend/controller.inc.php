<?php 
include "model.inc.php";

class usersController extends users
{
	public function registerUser($username, $password)
	{
	    $result = $this->countUser($username);
	    if($result['COUNT'] > 1)
	    {
	    	return false;
	    }
	    elseif($result['COUNT'] < 1)
	    {
		$this->InsertUser($username, $password);
		header("Location:/projects/sgepj/index.php");
	    }
	}

	
	public function loginUser($username, $password)
	{
	    $count = $this->countUser($username);

		if($count['COUNT'] <= 0)
		{ 
			echo "No such user found.";
		}
		else 
		{

		$result = $this->selectUser($username);

		if($result['username'] == $username)
		{
			if($result['status'] == 0)
			{
			 echo "Você não está autorizado a usar o sistema.";
			}
		   elseif($result['status'] == 1)
		   {
 
			if(password_verify($password, $result['password']))
			{
				session_start();
				$_SESSION['username'] = $username;
				$_SESSION['user_id'] = $result['id'];
				header("Location:/projects/SGEPJ/dashboard.php");
			}
			else
			{
				echo "Password Incorrect.";
			}
		   }	

		}
	  }
	}

	public function validatesesh($username)
	{
		if(empty($username))
		{
			header("Location:/projects/SGEPJ/index.php");
			return false;
		}
	}

	public function validatetype($user_id)
	{
		$row = $this->SelectUserType($user_id);

		if($row['type'] == 2)
		{
			header("Location: /projects/SGEPJ/dashboard.php");
		}
	}

	public function validatestatus($user_id)
	{
		$row = $this->SelectUserStatus($user_id);

		if($row['status'] == '0')
		{
			header("Location:/projects/SGEPJ/index.php");
		}
	}

	public function ModifyUser($user_id, $username, $password, $type, $status)
	{
		if(strlen($password) >= 1)
		{
		   $this->UpdateUser($user_id, $username, $password, $type, $status);
	    }
	    elseif(strlen($password <= 0)) 
	    {
	       $this->UpdateUserNoPass($user_id, $username, $type, $status);
	    }

		header("Location:/projects/SGEPJ/edit_user.php?user_id=".$user_id."");
	}

	public function EditUsername($user_id, $username)
	{

	  $this->UpdateUsername($user_id, $username);

	  header("Location: /projects/SGEPJ/config.php");

	}

    public function EditPassword($user_id, $password)
	{

	  $this->UpdatePassword($user_id, $password);

	  header("Location: /projects/SGEPJ/config.php");

	}

}


class cliController extends cli
{
	public function RegisterClient($uniq_id, $cli_name, $cli_cnpj, $cli_password, $cli_total_debt, $cli_num_quota, $cli_contract)
	{

		$cli_password = password_hash($cli_password, PASSWORD_DEFAULT);

		$this->InsertClient($uniq_id, $cli_name, $cli_cnpj, $cli_password, $cli_total_debt, $cli_num_quota, $cli_contract);

		$cli_quota_value = $cli_total_debt/$cli_num_quota; 

		$cli_id = $this->SelectClientId($uniq_id);

		mkdir("pdf/cli_".$cli_id['id']."");

		for($line_quota = 1; $line_quota <= $cli_num_quota; $line_quota++ )
		{
			$this->InsertQuota($cli_id['id'], $cli_quota_value, $line_quota);
		}

			header("Refresh:0");
	}

	public function ReCalculateCli($cli_id, $total_debt, $num_quota)
	{
		$this->DeleteOldQuota($cli_id);

		$quota_value = $total_debt/$num_quota;

		for($line_quota = 1; $line_quota <= $num_quota; $line_quota++)
		{
		    $this->InsertQuota($cli_id, $quota_value, $line_quota);
		}
		
	}


	public function setQuota($cli_id, $status, $quota_id)
	{
		$this->UpdateQuota($cli_id, $status, $quota_id);
		header("Location: /projects/sgepj/cli/quota.php?cli_id=".$cli_id." ");
	}

	public function setPDF($file, $cli_id, $quota_id)
	{		
	$file = $_FILES['file'];
	$filename = $_FILES['file']['name'];
	$filetype = $_FILES['file']['type'];
	$file_temp = $_FILES['file']['tmp_name'];
	$file_error = $_FILES['file']['error'];
	$file_size = $_FILES['file']['size'];

	$fileExt = explode('.',$filename);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('pdf');

	if(in_array($fileActualExt, $allowed))
	{
		if($file_error === 0)
		{
			if($file_size < 50000000)
			{
				$fileNameNew = 'quota_'.$quota_id.".".$fileActualExt;
				$filedestination = 'pdf/cli_'.$cli_id.'/'.$fileNameNew;
				move_uploaded_file($file_temp, $filedestination);
			}
			else
			{
				echo "Your file is too big.";
			}
		}
		else
		{
			echo "There was an error uploading your file.";
		}
	} 
	else 
	{
		echo "This file is not allowed";
	}

	}

	public function CliLogIn($cnpj, $password)
	{
		$count = $this->CountCli($cnpj, $password);

		if($count['COUNT'] <= 0)
		{
			echo "No such CNPJ found";
		}

		else 
		{
			$result = $this->SelectOneCli($cnpj);

			if($result['cnpj'] == $cnpj)
			{
				if(password_verify($password, $result['password']))
				{
					session_start();
					$_SESSION['cnpj'] = $cnpj;
					$_SESSION['cli_id'] = $result['id'];
					header("Location: /projects/SGEPJ/cli_area/dashboard_cli.php");
				}
				else
				{
					echo "Password Incorrect";
				}
			}
		}
	}

	public function SetNewInfo($cli_id, $name, $password, $cnpj, $contract)
	{
		if(strlen($password) >= 1 )
		{
		    $this->UpdateCliInfo($cli_id, $name, $password, $cnpj, $contract);
	    }
	    elseif(strlen($password) <= 0)
	    {
	    	$this->UpdateCliInfoNoPass($cli_id, $name, $cnpj, $contract);
	    }
	    
		header("Location:/projects/SGEPJ/cli/edit_cli.php?cli_id=".$cli_id."");
	}
}

class postsController extends posts
{
	public function SetPost($user_id, $title, $post)
	{
		$this->InsertPost($user_id, $title, $post);

		header("Location:/projects/SGEPJ/news/manage_posts.php");
	}

	public function EditPost($post_id, $title, $post)
	{
		 $this->UpdatePost($post_id, $title, $post);

		 header("Location:/projects/SGEPJ/news/edit_post.php?post_id= ".$post_id."");
	}
}




?>