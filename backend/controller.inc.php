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
			if(password_verify($password, $result['password']))
			{
				session_start();
				$_SESSION['username'] = $username;
				header("Location:/projects/SGEPJ/dashboard.php");
			}
			else
			{
				echo "Password Incorrect.";
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
}



?>