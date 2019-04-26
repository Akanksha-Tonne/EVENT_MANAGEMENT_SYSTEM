<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
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
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

	<div class="limiter">


		<div class="container-login100" style="background-image: url('images/bg.jpg');">

			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" name="frmUser" method="post" action="">
					<?php $message=""; if($message!="") { echo $message; } ?>
					<span class="login100-form-title p-b-49">
						Login
					</span>
					<div class="validate-input flex-c-m">
						<a  class="">
							<label for="doh">Domain Head<input class="radio validate_input_type" type="radio" name="ptype" id="doh" value='domains'></label>
						</a>
						<a  class="">
							<label for="evth">Event Head<input class="radio validate_input_type" type="radio" name="ptype" id="evth" value='event'></label>
						</a>

						<a  class="">
							<label for="par">Participant<input class="radio validate_input_type" type="radio" name="ptype" id="par" 
								value="participant"></label>
						</a>

						<a  class="">
							<label for="vol">Volunteer<input class="radio validate_input_type" type="radio" name="ptype" id="vol" value="volunteer"></label>
						</a>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Type your username">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<br><br><br>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div id="message"></div>
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
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
	<script src="js/main.js"></script>
<?php

				if(isset($_SESSION['userid']))
				{
					session_destroy();
					echo "<script>location.href='/ui/login_v4/index.php';
					</script>";
				}


else{

			$message="";
			if(count($_POST)>0) {
				//print_r($_POST);
				$ptype = $_POST['ptype'];
				$username = $_POST['username'];

				$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");


				if($ptype=='volunteer'){
					$result = pg_query("select * from ".
					$ptype.
					" where vid='".
					$username.
					"';");
					$row = pg_fetch_row($result);
					$name=$row[0];
					$_SESSION['username'] = $name;
					$_SESSION['userid'] = $username;
					$_SESSION['type'] = 'volunteer';
					echo "<script>location.href = '/ui/volunteer/volunteer_home.php'</script>";
				}
				elseif($ptype=='participant'){
					$result = pg_query("select * from participants where reg_id='".
					$username.
					"';");
					$row = pg_fetch_row($result);
					$name = $row[0];
					$reg_id = $row[2];
					$_SESSION['username'] = $name;
					$_SESSION['userid'] = $reg_id;
					$_SESSION['type'] = 'participant';
					echo "<script>location.href='/ui/Participants/participants.php'</script>";
				}
				elseif($ptype=='event'){
					$result = pg_query("select * from ".
					"event".
					" where Ecoord_id='".
					$username.
					"';");
					$row = pg_fetch_row($result);
					$_SESSION['userid'] = $username;
					$name = $row[4];
					$_SESSION['type'] = 'event';
					echo"<script>location.href='/UI/EVENT/event_head/events.php'</script>";

				}
				else{
					//
					$result = pg_query("select * from ".
					"domains".
					" where Dcoord_id='".
					$username.
					"';");
					$row = pg_fetch_row($result);
					$name = $row[1];
					$_SESSION['userid'] = $username;
					$_SESSION['type'] = 'domain';
					echo"<script>location.href='/UI/DOMAINS/domain_head/domains.php'</script>";


				}


				$count  = pg_num_rows($result);
				if($count==0) {
					$message = "Invalid Username or Password!";
					echo"<script>alert('$message');</script>";
				} else {
					/*$_SESSION['userid'] = $username;
					$_SESSION['ptype'] = $ptype;
					$_SESSION['username'] = $name;
					echo "<script>location.href = '".$path.".php'</script>";*/
				}



			}
}
?>
</body>
</html>
