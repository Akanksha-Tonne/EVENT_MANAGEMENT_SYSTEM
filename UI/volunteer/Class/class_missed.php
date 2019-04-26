<?php

               session_start();

               if (!(isset($_SESSION['userid'])))

               {
                               echo "<script>location.href='index.php'</script>";
               }
               else{
               		if($_SESSION['type'] != 'volunteer')
    			{
    				echo '<script>alert("Your are not authorized to view this page please login as Volunteer.");</script>';
      				echo "<script>location.href='/ui/login_v4/index.php'</script>";
				}

		  					   $db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");
                               $result = pg_query("select * from volunteer where vid= '".$_SESSION['userid']."';");
                               $row = pg_fetch_row($result);
                               $vname = $row[0];
                               $dname = $row[7];
                               $fname = $row[5];
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
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" name="frmUser" method="post" action="">
					<?php $message=""; if($message!="") { echo $message; } ?>
					<span class="login100-form-title p-b-49">
						Class Missed
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "required">
						<span class="label-input100">Date</span>
						<input class="input100" type="date" name="Date" placeholder="Date">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="required">
						<span class="label-input100">Time</span>
						<input class="input100" type="time" name="time" placeholder="Time">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="required">
						<span class="label-input100">Subject Code</span>
						<input class="input100" type="text" name="sub_code" placeholder="Subject Code">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
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
	$date = $_POST['Date'];
	$time = $_POST['time'];
	$sub_code = $_POST['sub_code'];
	

	$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");
	$result = pg_query("select * from class where vid_fk='".$_SESSION['userid']."';");

		$result = pg_query("INSERT INTO class VALUES('"
		.$time."','"
		.$date."','" 
		.$sub_code."','" 
		.$_SESSION['userid']."')");



		// if(!$result)
		// {
		// 	echo "<script>alert('Please enter valid details!!')</script>";
		// 	echo "<script>location.href='class_missed.php'</script>";
		// }
	}


	

?>