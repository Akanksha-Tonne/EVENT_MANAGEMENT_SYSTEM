<?php
 	session_start();
 	if (!(isset($_SESSION['userid'])))
 	{
 		echo "<script>location.href='/UI/Login_v4/index.php'</script>";
 	}
 	else{
 		if($_SESSION['type'] != 'domain'){
 			echo "<script>alert('You are not authorized to view this page. Please login as Domain Head!');
 			location.href = '/ui/Login_v4/index.php';
 			</script>";
 		}
 		$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");
 		$result = pg_query("select * from volunteer where vid= '".$_GET['part_id']."';");
 		$row = pg_fetch_assoc($result);
 		$name = $row['vname'];
		$vid = $row['vid'];
		$vphone = $row['vphone'];
		$vemail = $row['vemail_id'];
		$vtamt = $row['total_amt'];
		$vsamt = $row['amt_spent'];
		$fname = $row['dname_fk_v'];
 		
 	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Event Management</title>
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

	<link rel="stylesheet" type="text/css" href="navbar.css">
<!--===============================================================================================-->
<style type="text/css">
			.bg-light{
				background-color: rgba(255, 255, 255, 0.25)!important;

			}
			.colo:hover{
				font-color:white!important;
			}
		</style>
</head>
<body>
	
	<div class="limiter">
		<nav class="navbar sticky-top navbar-light bg-light">
			  <span class="navbar-brand mb-0 h1"><a class="nav_a" href="/UI/DOMAINS/domain_head/domains.php">Home</a></span>
			  <span class="navbar-brand colo"><a  href="/UI/Login_v4/index.php">Logout</a></span>
		</nav>

		<div class="container-login100" style="background-image: url('images/bg.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				
				<form class="login100-form validate-form" name="frmUser" method="post" action="">
					<?php $message=""; if($message!="") { echo $message; } ?>
					<span class="login100-form-title p-b-49">
						Edit Volunteer Information
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Name required">
						<span class="label-input100">Name:</span>
						<input class="input100" type="text" name="Name" placeholder="Name" value=<?php echo"$name"?>>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="ID required">
						<span class="label-input100">Volunteer ID:</span>
						<?php echo"$vid"?>
						
					</div>

					<div class="wrap-input100">
						<span class="label-input100">Volunteer Phone: </span>
						<input class="input100" type="telephone" name="vphone" placeholder="Volunteer Phone" value=<?php echo"$vphone"?> >
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="email required">
						<span class="glyphicon glyphicon-envelope"></span><span class="label-input100">Volunteer Email </span>
						<input class="input100" type="email" name="vemail" placeholder="Volunteer Email" value=<?php echo"$vemail"?>>
						<span class="focus-input100" data-symbol="&#xe0be;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Total Amount required">
						<span class="label-input100">Total Amount: </span>
						<input class="input100" type="number" name="vtamt" placeholder="Total Amount" value=<?php echo"$vtamt"?>>
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="required">
						<span class="label-input100">Amount Spent: </span><?php echo"$vsamt"?>
						
					</div>

					<div class="wrap-input100 validate-input" data-validate="required">
						<span class="label-input100">Fest Name: </span>
						<?php echo"$fname"?>
						
					</div>
					


					<br><br><br>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Update
							</button>
						</div>
						
					</div>
				</form>
			</div>
		</div>
	</div>
	

	
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
	<script src="navbar.js"></script>



<?php
$message="";
if(count($_POST)>0) {
	$name = $_POST['Name'];
	$vphone = $_POST['vphone'];
	$vemail = $_POST['vemail'];
	$vtamt = $_POST['vtamt'];
	// $dname = $_POST['dname'];

	$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");
	$result = pg_query("select * from volunteer where vid='".$vid."';");
	$count = pg_num_rows($result);
	if($count == 0){
		echo "<script>alert('Error in ID')</script>";
	}
	else{
		$result = pg_query("UPDATE  Volunteer SET vname='".$name."',vphone='".$vphone."',total_amt='".$vtamt."',amt_spent='".$vsamt."',amt_due='".($vtamt-$vsamt)."',vemail_id='".$vemail."' where vid='".$vid."';");



		if(!$result)
		{
			echo "<script>alert('Please enter valid details!!')</script>";
			// echo "<script>location.href='editVolunteer.php'</script>";
		}
		echo "<script>alert('Volunteer Details were updated !')</script>";
		echo "<script>location.href='/UI/DOMAINS/domain_head/volunteerdetails.php'</script>";
	}


	// echo "   '".$name."','".$vid."','".$vphone."','" .$vtamt."," .$vsamt."," .($vtamt-$vsamt).",'".$vemail."',"  .$dname."','" .$fname."')   ";
	

}
?>
</body>
</html>