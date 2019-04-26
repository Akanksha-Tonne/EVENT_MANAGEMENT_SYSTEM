<?php

 	session_start();
 	if (!(isset($_SESSION['userid'])))
 	{
 		echo "<script>location.href='/ui/login_v4/index.php'</script>";
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
 		$result = pg_query("select * from event where Ecoord_id= '".$_SESSION['userid']."';");
 		$row = pg_fetch_assoc($result);
 		$ecoord_name = $row['ecoord_name'];
 		$ename = $row['ename'];
 	}
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Event Management</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/css/main.css" />
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

    <nav class="navbar sticky-top navbar-light bg-light" style="width:100%;">
      <span class="navbar-brand mb-0 h1 colo"><a href="/UI/EVENT/event_head/events.php">Home</a></span>
      <span class="navbar-brand colo"><a href="/UI/Login_v4/index.php">Logout</a></span>
    </nav>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->

					<header id="header">
						<span class="avatar"><img src="images/avatar.jpg" alt="" /></span>
						<h1><?php echo $ename; ?><br><strong><?php echo $ecoord_name; ?><br></strong><?php echo$_SESSION['userid']; ?><br /></h1>
					</header>

				<!-- Main -->
					<section id="main">

						<!-- Thumbnails -->
							<section class="thumbnails" style="display: flex;justify-content: center;">
								<div>
									<a href="volunteerdetails.php"><h3>Volunteer List</h3></a>
									<a href="Add_form/addVolunteer.php"><h3>Add Volunteer</h3></a>
									<a href="Rem-form/remVolunteer.php"><h3>Remove Volunteer</h3></a>
								</div>
								<div>
									<a href="task_form/task/task_list.php"><h3>Task List</h3></a>
									<a href="Budget/budget_edit.php"><h3>Budget</h3></a>

								</div>

							</section>

					</section>
				<!-- Footer -->
					<footer id="footer">
						<p>&copy; Untitled. All rights reserved. Design: <a href="http://templated.co">TEMPLATED</a>. Demo Images: <a href="http://unsplash.com">Unsplash</a>.</p>
					</footer>

			</div>


<!-- No need of jquery libraries. -->

		<!-- Scripts -->
			<!-- <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/main.js"></script>

 -->
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>
