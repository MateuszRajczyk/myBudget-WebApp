<?php
	session_start();
	
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
						
						<li class="nav-item col-lg-2">
							<a class="nav-link" href="add-expense-website.php"><i class="icon-dollar"></i>Add Expense</a>
						</li>
						
						<li class="nav-item disabled dropdown col-lg-2">
							<a class="nav-link" href="#" aria-expanded="false" id="submenu" aria-haspopup="true"><i class="icon-chart-pie-alt" ></i>Show Balance</a>
							
							<div class="dropdown-menu" aria-labelledby="submenu">
							
								<a class="dropdown-item" href="show-balance-current-month-website.php" > Current Month </a>
								<a class="dropdown-item" href="show-balance-last-month-website.php" > Last Month </a>
								<a class="dropdown-item" href="show-balance-current-year-website.php" > Current Year </a>
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


	<div class="modal" tabindex="-1" role="dialog" id="dateModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Select time period</h3>
					
					<button type="button" class="close closeButton" data-bs-dismiss="modal">x</button>
				</div>
				
				<form class="mx-auto" method="post" action="show-balance-selected-time-period-website.php">
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


	<div class="bg-description-showBalance">
		<section class="container-fluid">
			<div class="row ">
				<div class="col-12 mt-2 ">
					<h5>
					
						<span class="chosenTimePeriod" ><?php

						if($_POST['date1'] >= $_POST['date2'])
						{
							$date1 = $_POST['date2']; 
							$date2 = $_POST['date1']; 
						}
						else if($_POST['date1'] <= $_POST['date2'])
						{
							$date1 = $_POST['date1'];
							$date2 = $_POST['date2'];
						}
						
						$dateShow1 = DateTime::createFromFormat("Y-m-d", $date1);
						
						echo $dateShow1->format("d.m.Y");
						
						?></span>
						
						-
						
						<span class="chosenTimePeriod" ><?php
						
							$dateShow2 = DateTime::createFromFormat("Y-m-d", $date2);
						
							echo $dateShow2->format("d.m.Y");
						?></span>
					
					
					</h5>
					
					<div class="btn-group choiceTimeButton me-4 mt-1">
						<button class="btn dropdown-toggle  " type="button" id="submenu" data-bs-toggle="dropdown" ><i class="icon-calendar"></i>Choose date</button>
						
						<div class="dropdown-menu dropdown-menu-end" aria-labelledby="submenu">
							<a class="dropdown-item" href="show-balance-current-month-website.php">Current Month</a>
							<a class="dropdown-item" href="show-balance-last-month-website.php">Last Month</a>
							<a class="dropdown-item" href="show-balance-current-year-website.php">Current Year</a>
							<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#dateModal">Selected period</a>
						</div>
					</div>
				</div>
			</div>	
		</section>
	</div>	

	<div class="container-fluid container-lg">
		<div class="row justify-content-center">
		
			<div class="table-responsive col-md-6 col-lg-6 col-12 mt-4 me-md-auto ">
		
				<div class="p-1 tIncomeExpense">Incomes</div>

				<table class="table table-bordered mb-0">
					
				<?php
					
				require_once "connectSQL.php";
				
				$connect = new mysqli($host, $db_user, $db_password, $db_name);
				
				$resultRowIncome = $connect->query("SELECT * FROM incomes, incomes_category_assigned_to_users WHERE incomes.userId= ".$_SESSION['id']." AND incomes.userId = incomes_category_assigned_to_users.userId AND incomes.incomeCategoryAssignedToUserId = incomes_category_assigned_to_users.id AND incomes.dateOfIncome >= '$date1' AND incomes.dateOfIncome <= '$date2' ORDER BY incomes.incomeCategoryAssignedToUserId ASC");
				
				$numRowsIncome = mysqli_num_rows($resultRowIncome);
				
				if($numRowsIncome>=1)
				{
					echo"
					<tr style='font-weight: 700;'>
						<td>Category</td>
						<td scope='col'>Date</td>
						<td scope='col'>Amount</td>
						<td scope='col'>Comment</td>
					</tr>";
				}
				
				$summaryIncome = 0;
				
				for ($i = 1; $i <= $numRowsIncome; $i++) 
				{
					
					$row = $resultRowIncome->fetch_assoc();
					$catName = $row['name'];	
					$date = $row['dateOfIncome'];
					$amount = $row['amount'];
					$comment = $row['incomeComment'];
					
					$summaryIncome += $amount;
					
					echo"
					<tr>
						<td>$catName</td>
						<td>$date</td>
						<td align='right'>$amount PLN</td>
						<td>$comment</td>
					</tr>";							
				}

				echo"</table>
				<table class='table'>
					<tr class='sumInExIn p-2'>
						<td align='left'>TOTAL</td>
						<td align='right' colspan='3'>".$summaryIncome." PLN</td>
					</tr>
				</table>";
				?>	

			</div>
			
			<div class="table-responsive col-md-6 col-lg-6 col-xl-6 col-12 mt-4">
				
				<div class="tIncomeExpense p-1">Expenses</div>
				
				<table class="table table-bordered mb-0">
				
				<?php
					$resultRowExpense = $connect->query("SELECT * FROM expenses, expenses_category_assigned_to_users WHERE expenses.userId= ".$_SESSION['id']." AND expenses.userId = expenses_category_assigned_to_users.userId AND expenses.expenseCategoryAssignedToUserId = expenses_category_assigned_to_users.id AND expenses.dateOfExpense >= '$date1' AND expenses.dateOfExpense <= '$date2' ORDER BY expenses.expenseCategoryAssignedToUserId ASC");
					
					$numRowsExpense = mysqli_num_rows($resultRowExpense);
					
					if($numRowsExpense>=1)
					{
						echo"
						<tr style='font-weight: 700'>
							<td>Category</td>
							<td>Date</td>
							<td>Amount</td>
							<td>Comment</td>
						</tr>";
					}
					
					$summaryExpense = 0;
					
					for ($i = 1; $i <= $numRowsExpense; $i++) 
					{
						
						$row = $resultRowExpense->fetch_assoc();
						$catName = $row['name'];	
						$date = $row['dateOfExpense'];
						$amount = $row['amount'];
						$comment = $row['expenseComment'];
						
						$summaryExpense += $amount;
						
						echo"
						<tr>
							<td>$catName</td>
							<td>$date</td>
							<td align='right'>$amount PLN</td>
							<td>$comment</td>
						</tr>";								
					}

				echo"</table>
				<table class='table'>
					<tr class='sumInExIn p-2'>
						<td align='left'>TOTAL</td>
						<td align='right' colspan='3'>".$summaryExpense." PLN</td>
					</tr>
				</table>";
				
				$connect->close();?>
						
			</div>
		</div>
	
	
		<div class="row justify-content-center">
			<div class="financeBalance col-5 col-md-4 col-lg-3 mt-5 p-2" style="border-radius: 5px">
			<?php
				$balance = $summaryIncome - $summaryExpense;
				echo "<div>Balance: ".$balance." PLN</div>"; 
				
			?>
			</div>
			<?php
			if($balance > 0)
			{
				echo "<div class='p-3' style='color:#31ad39; font-weight: 700;font-size: 18px;'>Perfect, you have savings! Keep it up!</div>";
			}
			else if($balance < 0)
			{
				echo "<div class='p-3' style='color:#cf1919; font-weight: 700; font-size: 18px;'>You are losing money! Improve your money management and start saving!</div>";
			}
			else
			{
				echo"<div class='p-3' style='color:#4f4646; font-weight: 700; font-size: 18px;'>No losses and no savings!</div>";
			}
			?>
		</div>

	</div>
	
	<footer class="mt-5">
		
		All rights reserved 2021 &copy; myhomebudget.com Thank you for your visit!
		
	</footer>
	
	
	<script src="jquery-3.6.0.min.js"></script>
	<script src="main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="BootstrapJs/bootstrap.min.js"></script>
</body>
</html>