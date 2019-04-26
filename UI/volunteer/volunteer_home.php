<?php

               session_start();

               if (!(isset($_SESSION['userid'])))

               {				session_destroy();

                               echo "<script>location.href='/ui/login_v4/index.php'</script>";

               }

               else{

               	if($_SESSION['type'] != 'volunteer')
    			{
    				echo '<script>alert("Your are not authorized to view this page please login as Volunteer.");</script>';
      				echo "<script>location.href='/ui/login_v4/index.php'</script>";
				}



                               /*echo $_SESSION['userid'].'<br>';

                               echo $_SESSION['ptype'].'<br>';

                               echo $_SESSION['username'].'<br>';*/

                               $db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");

                               $result = pg_query("select * from volunteer where vid= '".$_SESSION['userid']."';");

                               $row = pg_fetch_row($result);

                               $vname = $row[0];

                               $dname = $row[7];

                               $fname = $row[5];

               }

?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Visualize by TEMPLATED</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<style>
      .bg-light{
        background-color: rgb(255, 255, 255, 0.25)!important;
      }
      .colo{
        color:white!important;
      }
      .btn-success{
      	background-color: #b48387!important;
      	border-color: #b48387!important;
      }
    </style>

				<nav class="navbar sticky-top navbar-light bg-light" style="width:100%;">
				  <span class="navbar-brand colo mb-0 h1"><a href="/UI/volunteer/volunteer_home.php">Home</a></span>
				  <span class="navbar-brand colo "><a href="/UI/Login_v4/index.php">Logout</a></span>
		</nav>

		<!-- Wrapper -->
			<div id="wrapper">


				<!-- Header -->
					<header id="header">
						<span class="avatar"><img src="images/avatar.jpg" alt="" /></span>
						<h1><?php echo $dname; ?><br><strong><?php echo $vname; ?><br></strong><?php echo$_SESSION['userid']; ?><br /></h1>
						
					</header>


				<!-- Main -->
					<section id="main">

						<!-- Thumbnails -->
							<section class="thumbnails" style="display: flex;justify-content: center;">
								<div>
									<a href="Class/class_missed_list.php"><h3>Class Details</h3></a>
									<a href="task/task_list.php"><h3>Task List</h3></a>
									<a href="Budget/budget_edit.php">Budget</a>
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



	</body>
</html>

