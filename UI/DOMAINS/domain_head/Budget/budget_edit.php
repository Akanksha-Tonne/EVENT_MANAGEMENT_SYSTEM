<?php
	session_start();
 	if (!(isset($_SESSION['userid'])))
 	{
 		echo "<script>location.href='/UI/Login_v4/index.php'</script>";
 	}
 	else
 	{
 		if($_SESSION['type'] != 'domain'){
 			echo "<script>alert('You are not authorized to view this page. Please login as Domain Head!');
 			location.href = '/ui/Login_v4/index.php';
 			</script>";
 		}
		$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");
		$result = pg_query("select total_amt,amt_due from budget  where budget_id = (select budget_id_fk_domains from domains where dcoord_id='".$_SESSION['userid']."');");
		$row=pg_fetch_row($result);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V4</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<style type="text/css">
			.bg-light{
				background-color: rgba(255, 255, 255, 0.5)!important;

			}
		
		</style>
</head>
<body>
	
	<div class="limiter">
		<nav class="navbar sticky-top navbar-light bg-light" style="width:100%;">
				  <span class="navbar-brand mb-0 h1"><a href="/UI/DOMAINS/domain_head/domains.php">Home</a></span>
				  <span class="navbar-brand"><a href="/UI/Login_v4/index.php">Logout</a></span>
		</nav>
		<div class="container-login100" style="background-image: url('images/bg.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" name="frmUser" method="post" action="">
					<?php $message=""; if($message!="") { echo $message; } ?>
					<span class="login100-form-title p-b-49">
						Budget
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "required">
						<span class="label-input100" style="font-size: 15px;"> Total Amount : </span>
						<span class="label-input100"><?php echo $row[0];?></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="required">
						<span class="label-input100">Amount Spent</span>
						<input class="input100" type="number" name="amt_spent" placeholder="amt_spent">
						
					</div>

					<div class="wrap-input100 validate-input" data-validate="required">
						<span style="font-size: 15px;">Amount Due: </span>
						<span class="label-input100"><?php echo $row[1];?></span>
					</div>

					<br><br><br>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Submit
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>



</body>
</html>
<?php

$message="";
if(count($_POST)>0) {
	//print_r($_POST);
	$amt = $_POST['amt_spent'];
	
	$result = pg_query("select total_amt,amt_paid,amt_due from budget  where budget_id = (select budget_id_fk_domains from domains where dcoord_id='".$_SESSION['userid']."');");
	$row=pg_fetch_row($result);
	if($row[2] < $amt)
	{
		echo"<script>alert('Money spent exceeds the limit!!')</script>";
	}
	else
	{
		$amt_due = $row[2]-$amt;
		$amt_spent = $row[1] + $amt;
		$result = pg_query("UPDATE budget SET amt_paid=".$amt_spent." , amt_due= ".$amt_due." where budget_id= (select budget_id_fk_domains from domains where dcoord_id='".$_SESSION['userid']."');");
		echo"<script>location.href='budget_edit.php'</script>";
		
	}
	
		// if(!$result)
		// {
		// 	echo "<script>alert('Please enter valid details!!')</script>";
		// 	echo "<script>location.href='class_missed.php'</script>";
		// }
	}


	

?>