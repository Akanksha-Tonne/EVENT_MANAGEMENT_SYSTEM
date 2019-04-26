<?php
 	session_start();
 	if (!(isset($_SESSION['userid'])))
 	{
 		echo "<script>location.href='index.php'</script>";
 	}
 	else{
 		if($_SESSION['type'] != 'event'){
 			echo "Event";
 			echo "<script>alert('You are not authorized to view this page. Please login as Event Head!');</script>";
 			echo "<script>location.href='/ui/Login_v4/index.php'</script>";
 		}

 		
 		/*echo $_SESSION['userid'].'<br>';
 		echo $_SESSION['ptype'].'<br>';
 		echo $_SESSION['username'].'<br>';*/
 		$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");
 		$result = pg_query("select * from event where ecoord_id= '".$_SESSION['userid']."';");
 		$row = pg_fetch_assoc($result);
 		$ecoord_name = $row['ecoord_name'];
 		$ename = $row['ename'];
 		$fname = $row['fname_fk'];

    function get_num_of_volunteers($ename){
      $result = pg_query("select Ename_fk, count(*) from works_for where ename_fk='".$ename."' group by Ename_fk;");
      $row = pg_fetch_row($result);
      $num = $row[1];
      return $num;
    }

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
<!--===============================================================================================-->
<style>
      .bg-light{
        background-color: rgb(255, 255, 255, 0.25)!important;
      }
      .colo{
        color:white!important;
      }
    </style>
</head>
<body>

	<div class="limiter">
		<nav class="navbar sticky-top navbar-light bg-light" style="width:100%;">
				  <span class="navbar-brand mb-0 h1"><a href="/UI/EVENT/event_head/events.php">Home</a></span>
				  <span class="navbar-brand"><a href="/UI/Login_v4/index.php">Logout</a></span>
		</nav>

		<div class="container-login100" style="background-image: url('images/bg.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" name="frmUser" method="post" action="">
					<?php $message=""; if($message!="") { echo $message; } ?>
					<span class="login100-form-title p-b-49">
						Volunteer Information
					</span>

					<div class="wrap-input100 validate-input" data-validate="ID required">
						<span class="label-input100">Volunteer ID:</span>
						<input class="input100" type="text" name="vid" placeholder="Volunteer ID">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>




					<br><br><br>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Remove Volunteer
							</button>
							<span class="login100-form-title p-b-49">
						<?php echo get_num_of_volunteers($ename); ?>
					</span>
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
<?php
$message="";
if(count($_POST)>0) {
	//print_r($_POST);
	$vid = $_POST['vid'];
	$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=rachana");
	$result = pg_query("select * from volunteer where vid='".$vid."';");
	$count = pg_num_rows($result);
	if($count == 0){
		echo "<script>alert('Volunteer does not exists.Please enter valid details!')</script>";
	}
	else{
			$result = pg_query("DELETE FROM VOLUNTEER WHERE VID='".
				$vid.
				"'and exists(select * from works_for where vid='".$vid."' and ename_fk='".$ename."')");
        //print_r($result);
		if(!$result)
		{
			echo "<script>alert('Please enter valid details!')</script>";
			echo "<script>location.href='remVolunteer.php'</script>";
		}
		echo "<script>alert('Volunteer Removed !!!!')</script>";
		echo "<script>location.href='remVolunteer.php'</script>";
	}

}
?>
</body>
</html>
