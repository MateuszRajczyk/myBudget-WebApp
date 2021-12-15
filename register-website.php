<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		$validateSuccess=true;
		
		$userName = $_POST['userName'];
		
		if ((strlen($userName)<3) || (strlen($userName)>20))
		{
			$validateSuccess=false;
			$_SESSION['errUserName']="Name of user must have from 3 to 20 characters!";
		}
		
		if (ctype_alnum($userName)==false)
		{
			$validateSuccess=false;
			$_SESSION['errUserName']="Name of user must have only letters and numbers!";
		}
		
		$email = $_POST['email'];
		$email2 = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($email2, FILTER_VALIDATE_EMAIL)==false) || ($email2!=$email))
		{
			$validateSuccess=false;
			$_SESSION['errEmail']="Enter a correct email address!";
		}
		
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		
		if ((strlen($password1)<8) || (strlen($password1)>20))
		{
			$validateSuccess=false;
			$_SESSION['errPasswordLength']="Password must have from 8 to 20 characters!";
		}
		
		if ($password1!=$password2)
		{
			$validateSuccess=false;
			$_SESSION['errPasswordMatch']="Entered passwords are not match!";
		}	

		$password_hash = password_hash($password1, PASSWORD_DEFAULT);		
		
		$_SESSION['rememberUserName'] = $userName;
		$_SESSION['rememberEmail'] = $email;
		$_SESSION['rememberPassword1'] = $password1;
		$_SESSION['rememberPassword2'] = $password2;
		
		require_once "connectSQL.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$connect = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connect->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$result = $connect->query("SELECT id FROM users WHERE email='$email'");
				
				if (!$result) throw new Exception($connect->error);
				
				$emailAmount = $result->num_rows;
				if($emailAmount>0)
				{
					$validateSuccess=false;
					$_SESSION['errEmail']="Account with this e-mail already exists!";
				}		

				$result = $connect->query("SELECT id FROM users WHERE username='$userName'");
				
				if (!$result) throw new Exception($connect->error);
				
				$userNameAmount = $result->num_rows;
				if($userNameAmount>0)
				{
					$validateSuccess=false;
					$_SESSION['errUserName']="User with this name already exists!";
				}
				
				if ($validateSuccess==true)
				{
					if ($connect->query("INSERT INTO users VALUES (NULL, '$userName', '$password_hash', '$email')"))
					{
						$connect->query("INSERT INTO incomes_category_assigned_to_users(userId, name) SELECT users.id, incomes_category_default.name FROM users, incomes_category_default WHERE users.username='$userName'");
						$connect->query("INSERT INTO expenses_category_assigned_to_users(userId, name) SELECT users.id, expenses_category_default.name FROM users, expenses_category_default WHERE users.username='$userName'");
						$connect->query("INSERT INTO payment_methods_assigned_to_users(userId, name) SELECT users.id, payment_methods_default.name FROM users, payment_methods_default WHERE users.username='$userName'");
						$_SESSION['registerSuccessful']=true;
						header('Location: after-registration');
					}
					else
					{
						throw new Exception($connect->error);
					}
					
				}
				
				$connect->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Server error! Please register in another time!</span>';
		}
		
	}
	
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<title>My Home Budget</title>
	
	<meta name="description" content="Track your incomes and expenses - application to menagement your home finance" />
	<meta name="keywords" content="expense, incomes, finance menager, money menager, budget planner" />
	<meta name="author" content="Mateusz Rajczyk">
	
	<link rel="stylesheet" href="BootstrapCss/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	<link href='https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap' rel='stylesheet'>
	<link rel="stylesheet" href="main.css" type="text/css" />
	<script src="main.js"></script>
	
</head>

<body>
	<div class="container">
			<header>
				<div class="row justify-content-sm-evenly justify-content-md-between mb-4">
					<h1 class="text-md-start col-lg-6 col-md-8 mt-4 logo">
						<a href="home-budget" class="mButton">My Home Budget</a>
						<p class="col-sm-12 text-md-start subtitle">Application to menagement your home finance</p>
					</h1>

					<img src="img/money-bag-no-back.png" alt="money bag with dollar icon" class="d-md-block mt-4 logo-icon" style="width: 100px; height: 80px;" />
						
					<div class="col-sm-3 mt-4 d-lg-block adv">
					
						Start to control balance of your finances!
					
					</div>
				</div>
			</header>	
	</div>

	<div class="bg-description">
		<section class="container">
			<div class="row justify-content-center">
			
				<form class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 px-4 pt-4 pb-4 my-4 bg-white formStart" method="post">
					<div class="bg-header-fnc py-2 mb-4">
						
						Register new user
					
					</div>
					
					<div class="input-group-text">
						<div class="inputIcon">
							<i class="icon-user"></i>
						</div>
						
						<input type="text" name="userName" class="form-control" value="<?php
							if (isset($_SESSION['rememberUserName']))
							{
								echo $_SESSION['rememberUserName'];
								unset($_SESSION['rememberUserName']);
							}?>" placeholder="name" onfocus="this.placeholder=''" onblur="this.placeholder='name'" style="height: 40px" >
					</div>
					
					<?php
						if (isset($_SESSION['errUserName']))
						{
							echo '<div class="error" style="color:red">'.$_SESSION['errUserName'].'</div>';
							unset($_SESSION['errUserName']);
						}
					?>
					
					<div class="input-group-text">
						<div class="inputIcon">
							<i class="icon-mail-alt"></i>
						</div>
						
						<input type="text" name="email" class="form-control" value="<?php
							if (isset($_SESSION['rememberEmail']))
							{
								echo $_SESSION['rememberEmail'];
								unset($_SESSION['rememberEmail']);
							}?>" placeholder="email@adress.com" onfocus="this.placeholder=''" onblur="this.placeholder='email@adress.com'" style="height: 40px" >
					</div>
					
					<?php
						if (isset($_SESSION['errEmail']))
						{
							echo '<div class="error" style="color:red">'.$_SESSION['errEmail'].'</div>';
							unset($_SESSION['errEmail']);
						}
					?>
					
					<div class="input-group-text">
						<div class="inputIcon">
						
							<i class="icon-lock"></i>
						
						</div>
						
						<input type="password" name="password1" id="myInput" class="form-control" value="<?php
							if (isset($_SESSION['rememberPassword1']))
							{
								echo $_SESSION['rememberPassword1'];
								unset($_SESSION['rememberPassword1']);
							}?>" placeholder="password" onfocus="this.placeholder=''" onblur="this.placeholder='password'" style="height: 40px">
						
						<button type="button" class="inputIcon" id="toggler" onclick="showPassword()">
						
							<i class="icon-eye-1"></i>
						
						</button>
					
					</div>
					
					<?php
						if (isset($_SESSION['errPasswordLength']))
						{
							echo '<div class="error" style="color:red">'.$_SESSION['errPasswordLength'].'</div>';
							unset($_SESSION['errPasswordLength']);
						}
					?>
					
					<div class="input-group-text">
						<div class="inputIcon">
						
							<i class="icon-lock"></i>
						
						</div>
						
						<input type="password" name="password2" class="form-control" value="<?php
							if (isset($_SESSION['rememberPassword2']))
							{
								echo $_SESSION['rememberPassword2'];
								unset($_SESSION['rememberPassword2']);
							}?>" placeholder="confirm password" onfocus="this.placeholder=''" onblur="this.placeholder='confirm password'" style="height: 40px">
					</div>
					
					<?php
						if (isset($_SESSION['errPasswordMatch']))
						{
							echo '<div class="error" style="color:red">'.$_SESSION['errPasswordMatch'].'</div>';
							unset($_SESSION['errPasswordMatch']);
						}
					?>
					
					<button class="px-3 py-2 mt-4 mb-3 signButton" type="submit">
						<i class="icon-user-add"></i>
						Sign Up
					</button>
					
					<div>Already have an account?<a href="home-budget" class="ms-1 SignIn">Sign In</a></div>
					
				</form>
			</div>
		</section>
	</div>

	
	<footer class="mt-4">
			
		All rights reserved 2021 &copy; myhomebudget.com Thank you for your visit!
			
	</footer>
		
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="BootstrapJs/bootstrap.min.js"></script>
		
</body>
</html>