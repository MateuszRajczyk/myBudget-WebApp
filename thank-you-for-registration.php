<?php

	session_start();
	
	if (!isset($_SESSION['registerSuccessful']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['registerSuccessful']);
	}
	
	if (isset($_SESSION['rememberUserName'])) unset($_SESSION['rememberUserName']);
	if (isset($_SESSION['rememberEmail'])) unset($_SESSION['rememberEmail']);
	if (isset($_SESSION['rememberPassword1'])) unset($_SESSION['rememberPassword1']);
	if (isset($_SESSION['rememberPassword2'])) unset($_SESSION['rememberPassword2']);
	
	if (isset($_SESSION['errUserName'])) unset($_SESSION['errUserName']);
	if (isset($_SESSION['errEmail'])) unset($_SESSION['errEmail']);
	if (isset($_SESSION['errPasswordLength'])) unset($_SESSION['errPasswordLength']);
	if (isset($_SESSION['errPasswordMatch'])) unset($_SESSION['errPasswordMatch']);
	
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

	
</head>

<body>
	<div class="container">
			<header>
				<div class="row justify-content-sm-evenly justify-content-md-between mb-4">
					<h1 class="text-md-start col-lg-6 col-md-8 mt-4 logo">
						<a href="index.php" class="mButton">My Home Budget</a>
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
				<div class="col-10 mt-5 mb-5">
					<h4 class="text-success"><i class="icon-ok me-2"></i>Registered successfully</h4>
					<p style="color: #383733;">Thank you for registration! Now you can sign in for your new account.</p>
					
					<a class="btn btn-lg px-3 py-2 mt-3 signButton" href="index.php">
						<i class="icon-user-add"></i>
						Sign In
					</a>
				<div>
			</div>
		</section>
	</div>

	<div class="row justify-content-center">
		<footer class="mt-4 position-absolute bottom-0">
				
			All rights reserved 2021 &copy; myhomebudget.com Thank you for your visit!
				
		</footer>
	</div>
		
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="BootstrapJs/bootstrap.min.js"></script>
		
</body>
</html>