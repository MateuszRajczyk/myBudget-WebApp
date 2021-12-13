<?php

	session_start();
	
	if ((isset($_SESSION['loggedIn'])) && ($_SESSION['loggedIn']==true))
	{
		header('Location: home-user-website.php');
		exit();
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
			<div class="row justify-content-center justify-content-md-between">
				<div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5">
						
					<div class="oneOption mb-4 mt-4 p-2">
						
						<div class="d-inline-block descriptionImage">
						
							Checking your budget <br/> with charts
						
						</div>
						
						<i class="offset-1 icon-chart-pie-alt" style="font-size:55px; color:#ffffff;"></i>
					</div>
					
					<div class="oneOption mb-4 p-2">
		
						<div class="d-inline-block descriptionImage">
						
								Adding and removing <br/> incomes and expenses
						
						</div>
						
						<i class="offset-1 icon-basket" style="font-size:55px; color:#ffffff;"></i>
						
					</div>
					
					<div class="oneOption mb-4 p-2">
					
						<div class="d-inline-block descriptionImage">
								Keeping your balance <br/> of losses and savings
						</div>
						
						<i class="offset-1 icon-balance-scale" style="font-size:55px; color:#ffffff;"></i>
						
					
					</div>
						
				</div>
				
				
				<form class="col-11 col-sm-9 col-md-5 col-lg-5 col-xl-5 bg-white p-4 mt-2 mb-2 formStart" action="signIn.php" method="post">
					<div class="input-group-text">
						<div class="inputIcon">
							<i class="icon-mail-alt"></i>
						</div>
						<input type="text" class="form-control" name="email" placeholder="email@adress.com" onfocus="this.placeholder=''" onblur="this.placeholder='email@adress.com'" style="height: 40px">
					</div>
					
					<div class="input-group-text">
						<div class="inputIcon">
					
							<i class="icon-lock"></i> 
					
						</div>
					
						<input type="password" id="myInput" class="form-control" name="password" placeholder="password" onfocus="this.placeholder=''" onblur="this.placeholder='password'" style="height: 40px">
					
						<button type="button" class="inputIcon" id="toggler" onclick="showPassword()">
					
							<i class="icon-eye-1"></i>
					
						</button>
					</div>
					
<?php
	if(isset($_SESSION['error']))
	{	
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
?>
					
					<div class="input-group-text">
						<input type="checkbox" value="rememberMe" id="rememberMe" ><label for="rememberMe" class="ms-2">Remember me</label>
					</div>
					
					<button class="px-3 py-2 mt-2 signButton" type="submit" >
						<i class="icon-login"></i>
						Sign In
					</button>
					
					<div class="mt-2 mb-3">
						<a href="linkForgotPassword" class="forgotPassword">Forgot password?</a>
					</div>
					
					
					<div>Have no account yet? <br/> Register here:</div>
					
					
					<a class="btn btn-lg px-3 py-2 mt-3 signButton" href="register-website.php">
						<i class="icon-user-add"></i>
						Sign Up
					</a>
								
				</div>
				
			</form>
		
		</section>
	</div>
		
	<footer class="mt-4">
		
		All rights reserved 2021 &copy; myhomebudget.com Thank you for your visit!
		
	</footer>
	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="BootstrapJs/bootstrap.min.js"></script>
		
</body>
</html>