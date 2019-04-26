<?php
 	session_start();
 	if (!(isset($_SESSION['userid'])))
 	{
 		echo "<script>location.href='/UI/Login_v4/index.php'</script>";
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
 		$fname=$row['fname_fk'];

 		$result = pg_query("select  ename_fk ,count(*) from task group by  ename_fk having ename_fk='".$ename."';");
 		$row = pg_fetch_row($result);
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
	<script type="text/javascript">var t = 10;</script>
	
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
					<span class="login100-form-title p-b-49">
						Task Information
					</span>

					<div class="wrap-input100 validate-input" data-validate="ID required">
						<span class="label-input100">Task ID:</span>
						<input class="input100" type="text" name="taskid" placeholder="Task ID">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Name required">
						<span class="label-input100">Name:</span>
						<input class="input100" type="text" name="taskname" placeholder=" Task Name">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Prupose required">
						<span class="label-input100">Purpose:</span>
						<input class="input100" type="text" name="prupose" placeholder="Purpose ">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Date required">
						<span class="label-input100">Date</span>
						<input class="input100" type="text" name="task_date" placeholder="Date ">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Venue required">
						<span class="label-input100">Venue</span>
						<input class="input100" type="text" name="task_venue" placeholder="Venue">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<br><br><br>
					<div>
						<?php
					$res = pg_query("SELECT vid,vname FROM volunteer join works_for on vid=vid_fk WHERE ename_fk='".$ename."' and fname_fk_v = '".$fname."';");
					while($row1 = pg_fetch_row($res))
					{
						echo'<input type="checkbox" id="'.$row1[0].'" name="'.$row1[0].'"><label for="'.$row1[0].'">'.$row1[0].', '.$row1[1].'</label><br>
										';
					
					}
					?>
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Add Task
							</button>
							<span class="login100-form-title p-b-49">
								<?php echo $row[1];?>
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



<?php
$message="";
if(count($_POST)>0) {
	//print_r($_POST);
	$t_id = $_POST['taskid'];unset($_POST['taskid']);
	$t_name = $_POST['taskname'];unset($_POST['taskname']);
	$t_purpose = $_POST['prupose'];unset($_POST['prupose']);
	$t_date = $_POST['task_date'];unset($_POST['task_date']);
	$t_venue = $_POST['task_venue'];unset($_POST['task_venue']);

	$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");
	$result = pg_query("select * from task where task_id='".$t_id."';");
	$count = pg_num_rows($result);
	if($count != 0){
		echo "<script>alert('Task id already exists')</script>";
	}
	else{
		$result = pg_query("INSERT INTO task VALUES('".
			$t_id."','".
			$t_name."','".
			$t_purpose."',".
			"'PENDING','".
			$t_date."','".
			$t_venue."','".
			$ename."',null,'".
			$fname."')");

		foreach ($_POST as $key=>$value)
		{
				$result2 = pg_query("INSERT INTO PEOPLE_INVOLVED VALUES('".
					$key."','".
					$t_id.
					"');");

		}
		

		if(!$result)
		{
			echo "<script>alert('Please enter valid details!!')</script>";
			// echo "<script>location.href = ''</script>";
		}
		echo "<script>alert('Task Added !!!!')</script>";
			// echo "<script>location.href = 'addTask.php'</script>";
	}


	// echo "   '".$name."','".$vid."','".$vphone."','" .$vtamt."," .$vsamt."," .($vtamt-$vsamt).",'".$vemail."',"  .$dname."','" .$fname."')   ";
	

}
?>
</body>
</html>