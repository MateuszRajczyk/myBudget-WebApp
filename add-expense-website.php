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
				<div class="row justify-content-sm-evenly justify-content-md-between">
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
	
	<nav class="navbar navbar-light bg-navigation navbar-expand-lg mb-2">
	
		<button class="navbar-toggler ms-2 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Navigation toggler">
			<span class="navbar-toggler-icon"></span>
		</button>
	
		<div class="collapse navbar-collapse  " id="mainMenu">
			<div class="container">
				<div class="row ms-1 ">
					<ul class="navbar-nav">
					
						<li class="nav-item col-lg-2">
							<a class="nav-link" href="home-user-website.php"><i class="icon-home"></i>Home</a>
						</li>
						
						<li class="nav-item col-lg-2">
							<a class="nav-link" href="add-income-website.php"><i class="icon-money"></i>Add Income</a>
						</li>
						
						<li class="nav-item disabled col-lg-2">
							<a class="nav-link" href="add-expense-website.php"><i class="icon-dollar"></i>Add Expense</a>
						</li>
						
						<li class="nav-item dropdown col-lg-2">
							<a class="nav-link" href="#" aria-expanded="false" id="submenu" aria-haspopup="true"><i class="icon-chart-pie-alt" ></i>Show Balance</a>
							
							<div class="dropdown-menu" aria-labelledby="submenu">
							
								<a class="dropdown-item" href="#"> Current Month </a>
								<a class="dropdown-item" href="#"> Last Month </a>
								<a class="dropdown-item" href="#"> Current Year </a>
								<a class="dropdown-item" href="#"> Selected Period </a>
							
							</div>
							
						</li>
						
						<li class="nav-item dropdown col-lg-2">
							<a class="nav-link" href="#" aria-expanded="false" id="submenu" aria-haspopup="true"><i class="icon-cog"></i>Settings</a>
							
							<div class="dropdown-menu" aria-labelledby="submenu">
							
								<a class="dropdown-item" href="#"> User </a>
								
								<div class="dropdown-divider"></div>
								
								<a class="dropdown-item" href="#"> Income </a>
								<a class="dropdown-item" href="#"> Expense </a>
								
								<div class="dropdown-divider"></div>
								
								<a class="dropdown-item" href="#"> Payment Methods </a>
							
							</div>
							
						</li>
						
						<li class="nav-item col-lg-2">
							<a class="nav-link" href="signOut.php"><i class="icon-logout"></i>Sign out</a>
						</li>
					
					</ul>
				</div>
			</div>
		</div>
	
	</nav>

	<div class="bg-description">
		<section class="container">
			<div class="row justify-content-center">
			
				<form class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 px-4 pt-4 pb-4 my-4 bg-white formStart">
				
					<div class="bg-header-fnc py-2 mb-4">
						
						Adding an expense
					
					</div>
					
					<div class="input-group-text">
						<div class="descriptionLabel px-2">
							Amount
						</div>
						
						<input class="form-control" type="number" step="0.01" name="amount" required >
					</div>
					
					<div class="input-group-text">
						<div class="descriptionLabel px-2">
							Date
						</div>
						
						<input class="form-control" type="date" name="date" >
					</div>
					
					<div class="input-group-text">
						<div class="descriptionLabel px-2">
							Payment Method
						</div>
					
						<select class="form-select userChoice" name="payment" >
					
							<option value="cash">cash</option>		
							<option value="debit">debit card</option>		
							<option value="credit">credit card</option>	
							<option value="blik">blik payment</option>	
							<option value="other">other</option>	
							<option value="main" disabled hidden selected>- payment method -</option>
						</select>
							
					</div>
					
					<div class="input-group-text">
						<div class="descriptionLabel px-2">
							Category
						</div>
						
						<select class="form-select userChoice" name="category">
					
							<option value="food">food</option>		
							<option value="house">house</option>		
							<option value="transport">transport</option>	
							<option value="books">books</option>	
							<option value="other">other</option>	
							<option value="select" disabled hidden selected>- select category -</option>
						</select>
						
					</div>
					
					<div class="input-group-text">
						<div class="descriptionLabel comment px-2 pt-4">
						
							Comments <br>(optional)
						
						</div>
						
						<textarea name="comment" class="comment" rows="3" cols="39"></textarea>
						
					</div>
					
					
					<button class="mt-4 me-5 addExpenseB px-4 py-2 "><i class="icon-floppy"></i>Save</button>				

					<button class="addExpenseB px-4 py-2"><i class="icon-cancel-circled"></i>Cancel</button>
					
				</form>
			</div>
		</section>
	</div>
		
	<footer>
		
		All rights reserved 2021 &copy; myhomebudget.com Thank you for your visit!
		
	</footer>
		
		
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="BootstrapJs/bootstrap.min.js"></script>
</body>
</html>