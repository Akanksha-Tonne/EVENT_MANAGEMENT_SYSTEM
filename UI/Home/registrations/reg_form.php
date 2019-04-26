<?php
	$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");
	

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
</head>
<body>
	
	<div class="limiter">
		

		<div class="container-login100" style="background-image: url('images/bg.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				
				<form class="login100-form validate-form" name="frmUser" method="post" action="">
					<span class="login100-form-title p-b-49">
						Participant Information
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Name required">
						<span class="label-input100">Name:</span>
						<input class="input100" type="text" name="Name" placeholder="Name">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="ID required">
						<span class="label-input100">ID:</span>
						<input class="input100" type="text" name="vid" placeholder="Participant ID">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100">
						<span class="label-input100">Phone: </span>
						<input class="input100" type="telephone" name="vphone" placeholder="Participant Phone">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="email required">
						<span class="glyphicon glyphicon-email"></span><span class="label-input100">Email </span>
						<input class="input100" type="email" name="vemail" placeholder="Participant Email">
						<span class="focus-input100" data-symbol="&#xe0be;"></span>
					</div>

					<?php
					$result = pg_query("SELECT ENAME FROM EVENT WHERE evt_date>current_date ;");
					while($row = pg_fetch_row($result))
					{
						echo'<label for="'.$row[0].'">'.$row[0].'</label>
							<input type="checkbox" id="'.$row[0].'" name="'.$row[0].'"><br>';
					
					}
					?>
					<br><br><br>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Add Participant
							</button>s
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
	$name = $_POST['Name'];unset($_POST['Name']);
	$vid = $_POST['vid'];unset($_POST['vid']);
	$vphone = $_POST['vphone'];unset($_POST['vphone']);
	$vemail = $_POST['vemail'];unset($_POST['vemail']);

	
	$result = pg_query("select * from participant where vid='".$vid."';");
	$count = pg_num_rows($result);

		//foreach ($_POST as $key=>$value){ echo"<script>alert('".$key.$value."')</script>"; }
	if($count != 0){
		echo "<script>alert('Participant ID already exists')</script>";
		echo "<script>location.href='reg_form.php'</script>";
	}
	else{
		$result = pg_query("INSERT INTO participants VALUES('"
		.$name."','"
		.$vemail."','" 
		.$vid."','"
		.$vphone."')");
		echo"$result";
		if(!$result)
		{
			echo "<script>alert('Please enter valid details!!')</script>";
			// echo "<script>location.href='reg_form.php'</script>";
		}
		else{
		echo "<script>alert('participants Added !!!!')</script>";
		//print_r ($_POST);
		foreach ($_POST as $key=>$value)
		{
				echo"<script>alert('participants Added !!!!')</script>";
				$result = pg_query("INSERT INTO PARTICIPATES_IN VALUES('".
					$vid."','".
					$key.
					"');");

		}
		echo "<script>location.href='reg_form.php'</script>";
	}
	}


	// echo "   '".$name."','".$vid."','".$vphone."','" .$vtamt."," .$vsamt."," .($vtamt-$vsamt).",'".$vemail."',"  .$dname."','" .$fname."')   ";
	

}
?>
</body>
</html>