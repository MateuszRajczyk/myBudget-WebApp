<?php

	session_start();
	
	if ((!isset($_POST['email'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "connectSQL.php";

	$connect = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($connect->connect_errno!=0)
	{
		echo "Error: ".$connect->connect_errno;
	}
	else
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$email = htmlentities($email, ENT_QUOTES, "UTF-8");
	
		if ($result = @$connect->query(
		sprintf("SELECT * FROM users WHERE email='%s'",
		mysqli_real_escape_string($connect,$email))))
		{
			$users_amount = $result->num_rows;
			if($users_amount>0)
			{
				$row = $result->fetch_assoc();
				
				if(password_verify($password,$row['password']))
				{
					$_SESSION['loggedIn'] = true;
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['email'] = $row['email'];
					
					if(!empty($_POST['remember']))
					{
						setcookie("email", $_POST['email'], time()+(10*365*24*60*60));
						setcookie("password", $_POST['password'], time()+(10*365*24*60*60));
					}
					else
					{
						if(isset($_COOKIE['email']) && isset($_COOKIE['password']))
						{
							setcookie("email", "");
							setcookie("password", "");
						}
					}
					
					unset($_SESSION['error']);
					$result->free_result();
					header('Location: home-user-website.php');
				}
				else 
				{
					$_SESSION['error'] = '<span style="color:red"><span class="me-2 text-left" style="font-weight: 700; font-size: 23px;">x</span>Incorrect entered email or password!</span>';
					header('Location: index.php');
				}
				
			} else {
				
				$_SESSION['error'] = '<span style="color:red"><span class="me-2 text-left" style="font-weight: 700; font-size: 23px;">x</span>Incorrect entered email or password!</span>';
				header('Location: index.php');
				
			}
			
		}
		
		$connect->close();
	}
	
?>