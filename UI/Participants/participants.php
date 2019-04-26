<?php
 	session_start();
 	if (!(isset($_SESSION['userid'])))
 	{
 		echo "<script>location.href='/ui/login_v4/index.php'</script>";
 	}
 	else{
    if($_SESSION['type'] != 'participant')
    {echo '<script>alert("Your are not authorized to view this page please login as Participant.");</script>';
      echo "<script>location.href='/ui/login_v4/index.php'</script>";

    }
 		$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");
 		$p_name = $_SESSION['username'];
 		$p_reg_id = $_SESSION['userid'];
 	}
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Event Management</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      .bg-light{
        background-color: rgba(255, 255, 255, 0.25)!important;
      }
      .colo{
        color: white!important;
      }
    </style>
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Wrapper -->
    <nav class="navbar sticky-top navbar-light bg-light" style="width:100%;">
      <span class="navbar-brand mb-0 h1 colo"><a href="participants.php">Home</a></span>
      <span class="navbar-brand colo"><a href="/UI/Login_v4/index.php">Logout</a></span>
    </nav>
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<span class="avatar"><img src="images/avatar.jpg" alt="" /></span>
						<h1><br><strong><?php echo $p_name; ?><br></strong><br><?php echo $p_reg_id; ?><br /></h1>
					</header>

				<!-- Main -->
					<section id="main">

						<!-- Thumbnails -->
						<table style="font-size:20px;text-align:center;" class='table-bordered tabel-hover'>
		<tr><strong>
			<th>Event Name</th>
			<th>Event Date</th>
			<th>Event Time</th>
      <th></th>
		</strong>
		</tr>
							<?php
							$result = pg_query("
select ename_fk, evt_date, start_time from ((participants join participates_in on reg_id='".$p_reg_id."' and reg_id=reg_id_fk) join event on ename_fk=ename);
");
							while($row = pg_fetch_row($result))
								{
								echo "<tr>";
								echo "<td>".$row[0]."</td>";
								echo "<td>".$row[1]."</td>";
								echo "<td>".$row[2]."</td>";
                echo "<td><form action='withdraw.php' method='post'><input type='hidden' name='event'  value='".$row[0]."'><button onclick='withdrawButton(".'"'.$row[0].'"'.")'>Withdraw</button></from></td>";
								echo "</tr>";
							}
							?>

	</table>













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
 <script>
  function withdrawButton(e){
    localStorage.setItem("event", e);

 //   localStorage.setItem("event", e.target);
 }
 </script>
	</body>
</html>
