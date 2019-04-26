<?php
 	session_start();
 	if (!(isset($_SESSION['userid'])))
 	{
 		echo "<script>location.href='index.php'</script>";
 	}
 	else{
 		/*echo $_SESSION['userid'].'<br>';
 		echo $_SESSION['ptype'].'<br>';
 		echo $_SESSION['username'].'<br>';*/
 		if($_SESSION['type'] != 'event'){
 			echo "Event";
 			echo "<script>alert('You are not authorized to view this page. Please login as Event Head!');</script>";
 			echo "<script>location.href='/ui/Login_v4/index.php'</script>";
 		}
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

	<link rel="stylesheet" type="text/css" href="navbar.css">
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
				  <span class="navbar-brand colo mb-0 h1"><a href="/UI/EVENT/event_head/events.php">Home</a></span>
				  <span class="navbar-brand colo"><a href="/UI/Login_v4/index.php">Logout</a></span>
		</nav>

		<div class="container-login100" style="background-image: url('images/bg.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">

				<form class="login100-form validate-form" name="frmUser" method="post" action="">
					<?php $message=""; if($message!="") { echo $message; } ?>
					<span class="login100-form-title p-b-49">
						Volunteer Information
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Name required">
						<span class="label-input100">Name:</span>
						<input class="input100" type="text" name="Name" placeholder="Name">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="ID required">
						<span class="label-input100">Volunteer ID:</span>
						<input class="input100" type="text" name="vid" placeholder="Volunteer ID">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100">
						<span class="label-input100">Volunteer Phone: </span>
						<input class="input100" type="telephone" name="vphone" placeholder="Volunteer Phone">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="email required">
						<span class="glyphicon glyphicon-envelope"></span><span class="label-input100">Volunteer Email </span>
						<input class="input100" type="email" name="vemail" placeholder="Volunteer Email">
						<span class="focus-input100" data-symbol="&#xe0be;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Total Amount required">
						<span class="label-input100">Total Amount: </span>
						<input class="input100" type="number" name="vtamt" placeholder="Total Amount">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="required">
						<span class="label-input100">Amount Spent: </span>
						<input class="input100" type="number" name="vsamt" placeholder="Amount Spent">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>





					<br><br><br>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Add Volunteer
							</button>
							<span class="login100-form-title p-b-49">
						<?php echo get_num_of_volunteers($ename) ?>
					</span>
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
	//print_r($_POST);
	$name = $_POST['Name'];
	$vid = $_POST['vid'];
	$vphone = $_POST['vphone'];
	$vemail = $_POST['vemail'];
	$vtamt = $_POST['vtamt'];
	$vsamt = $_POST['vsamt'];
	// $dname = $_POST['dname'];
  $dname = NULL;

	$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=rachana");
	$result = pg_query("select * from volunteer where vid='".$vid."';");
	$count = pg_num_rows($result);
	if($count != 0){
		echo "<script>alert('Volunteer ID already exists')</script>";
	}
	else{
		$result1 = pg_query("INSERT INTO Volunteer VALUES('"
		.$name."','"
		.$vid."','"
		.$vphone."',"
		.$vtamt.","
		.$vsamt.","
		.($vtamt-$vsamt).",'"
		.$vemail."','"
		.$dname.","
		.$fname."')");

    $result2 = pg_query("INSERT INTO WORKS_FOR VALUES ('"
    .$ename."','"
    .$vid."')");



		if(!($result1 && $result2))
		{
			echo "<script>alert('Please enter valid details!!')</script>";
			echo "<script>location.href='addVolunteer.php'</script>";
		}
		echo "<script>alert('Volunteer Added !!!!')</script>";
		echo "<script>window.location.reload()</script>";
	}


	// echo "   '".$name."','".$vid."','".$vphone."','" .$vtamt."," .$vsamt."," .($vtamt-$vsamt).",'".$vemail."',"  .$dname."','" .$fname."')   ";


}
?>
</body>
</html>
