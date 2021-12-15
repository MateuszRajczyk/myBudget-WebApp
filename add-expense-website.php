<?php

	session_start();
	
	
	if(isset($_POST['amount']))
	{	
		$validateSuccess=true;
		
		if($_POST['amount']=="")
		{
			$validateSuccess=false;
			$_SESSION['errAmount']="The amount field is required!";
		}
		else
		{
			$amount = $_POST['amount'];
			$_SESSION['rememberAmount'] = $amount;
		}
		
		$date = $_POST['date'];
		
		$_SESSION['rememberDate'] = $date;
		
		if(!isset($_POST['paymentM']))
		{
			$validateSuccess=false;
			$_SESSION['errPaymentM']="The payment method field is required!";
		}
		else
		{
			$paymentMethod = $_POST['paymentM'];
			$_SESSION['rememberPaymentM'] = $paymentMethod;
		}
			
		if(!isset($_POST['category']))
		{
			$validateSuccess=false;
			$_SESSION['errCategory']="The category field is required!";
		}
		else
		{
			$categoryId = $_POST['category'];
			$_SESSION['rememberCategory'] = $categoryId;
		}
		
		$comment = $_POST['comment'];

		$_SESSION['rememberComment'] = $comment;
		
		
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
				if($validateSuccess == true)
				{
					if($idUser = $connect->query("SELECT id FROM users WHERE id=".$_SESSION['id']))
					{
						while($rowIdUser=mysqli_fetch_array($idUser, MYSQLI_ASSOC))
						{
							$connect->query("INSERT INTO expenses VALUES (NULL, ".$rowIdUser['id'].", '$amount', '$categoryId', '$paymentMethod' ,'$comment', '$date')");
							unset($_SESSION['rememberAmount']);
							unset($_SESSION['rememberCategory']);
							unset($_SESSION['rememberPaymentM']);
							unset($_SESSION['rememberComment']);
							unset($_SESSION['rememberDate']);
							
							echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>";
							echo "<script>
							$(document).ready(function(){
								$('#expenseModalSuccess').modal('show');
							});
							</script>";
						}
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
			echo '<span style="color:red;">Server error! Please add expense in another time!</span>';
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
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
	
</head>

<body>
	<div class="container">
			<header>
				<div class="row justify-content-sm-evenly justify-content-md-between">
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
	
	<nav class="navbar navbar-light bg-navigation navbar-expand-lg mb-2">
	
		<button class="navbar-toggler ms-2 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Navigation toggler">
			<span class="navbar-toggler-icon"></span>
		</button>
	
		<div class="collapse navbar-collapse  " id="mainMenu">
			<div class="container">
				<div class="row ms-1 ">
					<ul class="navbar-nav">
					
						<li class="nav-item col-lg-2">
							<a class="nav-link" href="user-main"><i class="icon-home"></i>Home</a>
						</li>
						
						<li class="nav-item col-lg-2">
							<a class="nav-link" href="add-income"><i class="icon-money"></i>Add Income</a>
						</li>
						
						<li class="nav-item disabled col-lg-2">
							<a class="nav-link" href="add-expense"><i class="icon-dollar"></i>Add Expense</a>
						</li>
						
						<li class="nav-item dropdown col-lg-2">
							<a class="nav-link" href="#" aria-expanded="false" id="submenu" aria-haspopup="true"><i class="icon-chart-pie-alt" ></i>Show Balance</a>
							
							<div class="dropdown-menu" aria-labelledby="submenu">
							
								<a class="dropdown-item" href="current-month"> Current Month </a>
								<a class="dropdown-item" href="last-month"> Last Month </a>
								<a class="dropdown-item" href="current-year"> Current Year </a>
								<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#dateModal"> Selected Period </a>
							
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
	
	<div class="modal hide fade in" tabindex="-1" role="dialog" id="dateModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Select time period</h3>
					
					<button type="button" class="close closeButton" data-bs-dismiss="modal">x</button>
				</div>
				
				<form class="mx-auto" method="post" action="selected-period">
					<div class="modal-body">
						<h5>Select a start date and end date for look at balance in choosing time period</h5>
						
						<div class="row justify-content-center">
							<div class="form-group col-5 mt-3 mb-3">
								<span>Start date</span>
								
								<input class="form-control" type="date" name="date1" value="<?php echo date('Y-m-d'); ?>">
							</div>
							
							<div class="form-group col-5 mt-3 mb-3">
								<span>End date</span>
								
								<input class="form-control" type="date" name="date2" value="<?php echo date('Y-m-d'); ?>">
							</div>
							
							<?php
							
							if(isset($_POST['date1']))
							{
								header('Location: selected-period');
							}
							
							?>
						</div>
					</div>
					
					<div class="modal-footer mt-2 mb-2">
						<button class="btn footerButtons" type="submit">Save</button>
						
						<button type="button" class="btn footerButtons" data-bs-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	
	</div>
	
	<div class="modal hide fade in" tabindex="-1" role="dialog" id="expenseModalCancel" data-bs-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-xl">
				<div class="modal-header">
					<h4 class="modal-title">Do you want to cancel?</h4>
					
					<button type="button" class="close closeButton" data-bs-dismiss="modal">x</button>
				</div>
				
				<div class="modal-body mt-3">
					<h5>The data you have entered into the form will not be saved.</h5>
				</div>
				
				<div class="modal-footer mt-2 mb-2">
					<a class="btn footerButtons" href="user-main">YES</a>
					
					<button class="btn footerButtons" type="button" data-bs-dismiss="modal">NO</button>
					
				</div>

			</div>
		</div>
	
	</div>
	
	<div class="modal hide fade in" tabindex="-1" role="dialog" id="expenseModalSuccess" data-bs-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-xl">
				<div class="modal-header">			
					<button type="button" class="close closeButton" data-bs-dismiss="modal">x</button>
				</div>
				
				<div class="modal-body mt-3">
					<h5>The expense which you entered has been successfully added.</h5>
				</div>
				
				<div class="modal-footer mt-2 mb-2">
					
					<button class="btn footerButtons" type="button" data-bs-dismiss="modal">OK</button>
					
				</div>

			</div>
		</div>
	
	</div>

	<div class="bg-description">
		<section class="container">
			<div class="row justify-content-center">
			
				<form class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 px-4 pt-4 pb-4 my-4 bg-white formStart" method="post">
				
					<div class="bg-header-fnc py-2 mb-4">
						
						Adding an expense
					
					</div>
					
					<div class="input-group-text">
						<div class="descriptionLabel px-2">
							Amount
						</div>
						
						<input class="form-control" type="number" step="0.01" name="amount" value="<?php
							if (isset($_SESSION['rememberAmount']))
							{
								echo $_SESSION['rememberAmount'];
								unset($_SESSION['rememberAmount']);
							}?>">
					</div>
					
					<?php
						if (isset($_SESSION['errAmount']))
						{
							echo '<div class="error" style="color:red"><span class="me-2 text-left" style="font-weight: 700; font-size: 23px;">x</span>'.$_SESSION['errAmount'].'</div>';
							unset($_SESSION['errAmount']);
						}
					?>
					
					<div class="input-group-text">
						<div class="descriptionLabel px-2">
							Date
						</div>
						
						<input class="form-control" type="date" name="date" value="<?php
							if (isset($_SESSION['rememberDate']))
							{
								echo $_SESSION['rememberDate'];
								unset($_SESSION['rememberDate']);
							}else
							{
								echo date('Y-m-d');
							}?>">
					</div>
					
					<div class="input-group-text">
						<div class="descriptionLabel px-2">
							Payment Method
						</div>
					
						<select class="form-select userChoice" name="paymentM" >
						
							<option value="" disabled hidden selected>- payment method -</option>
							<?php
							require_once "connectSQL.php";
							$connect = new mysqli($host, $db_user, $db_password, $db_name);
							if($result = $connect->query("SELECT * FROM payment_methods_assigned_to_users WHERE userid=".$_SESSION['id']))
							{
								while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
								{
									echo '<option value='.$row["id"];
									
									if ((isset($_SESSION['rememberPaymentM'])) && ($_SESSION['rememberPaymentM'] == $row["id"]))
									{
										echo ' selected = "selected"';
										unset($_SESSION['rememberPaymentM']);
									}
									
									echo ' >'.$row["name"].'</option>';
								}
							}
							?>
						</select>
							
					</div>
					
					<?php
						if (isset($_SESSION['errPaymentM']))
						{
							echo '<div class="error" style="color:red"><span class="me-2 text-left" style="font-weight: 700; font-size: 23px;">x</span>'.$_SESSION['errPaymentM'].'</div>';
							unset($_SESSION['errPaymentM']);
						}
					?>
					
					<div class="input-group-text">
						<div class="descriptionLabel px-2">
							Category
						</div>
						
						<select class="form-select userChoice" name="category">
						
							<option value="" disabled hidden selected>- select category -</option>
							<?php
							require_once "connectSQL.php";
							$connect = new mysqli($host, $db_user, $db_password, $db_name);
							if($result = $connect->query("SELECT * FROM expenses_category_assigned_to_users WHERE userid=".$_SESSION['id']))
							{
								while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
								{
									echo '<option value='.$row["id"];
									
									if ((isset($_SESSION['rememberCategory'])) && ($_SESSION['rememberCategory'] == $row["id"]))
									{
										echo ' selected = "selected"';
										unset($_SESSION['rememberCategory']);
									}
									
									echo ' >'.$row["name"].'</option>';
								}
							}
							?>
						</select>
						
					</div>
					
					<?php
						if (isset($_SESSION['errCategory']))
						{
							echo '<div class="error" style="color:red"><span class="me-2 text-left" style="font-weight: 700; font-size: 23px;">x</span>'.$_SESSION['errCategory'].'</div>';
							unset($_SESSION['errCategory']);
						}
					?>
					
					<div class="input-group-text">
						<div class="descriptionLabel comment px-2 pt-4">
						
							Comments <br>(optional)
						
						</div>
						
						<textarea name="comment" class="comment" rows="3" cols="39"><?php
							if (isset($_SESSION['rememberComment']))
							{
								echo $_SESSION['rememberComment'];
								unset($_SESSION['rememberComment']);
							}?></textarea>
						
					</div>
					
					
					<button class="btn mt-4 me-5 addExpenseB px-4 py-2 " type="submit"><i class="icon-floppy"></i>Save</button>				

					<a data-bs-toggle="modal" data-bs-target="#expenseModalCancel"><button class="btn addExpenseB mt-4 px-4 py-2"><i class="icon-cancel-circled"></i>Cancel</button></a>
					
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