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
 		/*echo $_SESSION['userid'].'<br>';
 		echo $_SESSION['ptype'].'<br>';
 		echo $_SESSION['username'].'<br>';*/
 		$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");
 		$result = pg_query("select * from domains where Dcoord_id= '".$_SESSION['userid']."';");
 		$row = pg_fetch_row($result);
 		$dcoord_name = $row[1];
 		$dname = $row[0];
 		$fname=$row[5];
 		$result = pg_query("select * from volunteer where dname_fk_v='".$dname."' and fname_fk_v='".$fname."';");
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
		<style type="text/css">
			.bg-light{
				background-color: rgba(255, 255, 255, 0.25)!important;
			}
		</style>
	</head>
	<body>

		<!-- Wrapper -->
		<nav class="navbar sticky-top navbar-light bg-light" style="width:100%;">
				  <span class="navbar-brand mb-0 h1"><a href="/UI/DOMAINS/domain_head/domains.php">Home</a></span>
				  <span class="navbar-brand"><a href="/UI/Login_v4/index.php">Logout</a></span>
		</nav>
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<span class="avatar"><img src="images/avatar.jpg" alt="" /></span>
						<h1><?php echo $dname; ?><br><strong><?php echo $dcoord_name; ?><br></strong><?php echo$_SESSION['userid']; echo '<br>'.$fname;?><br /></h1>
						<h1><strong>Volunteer Details<br></strong><br /></h1>
						<div id="list" class="container">
	<table style="font-size:20px;text-align:center;" class='table-bordered tabel-hover'>
		<tr><strong>
			<th>Name</th>
			<th>Id</th>
			<th>Phone</th>
			<th>Total Amount</th>
			<th>Amount spent</th>
			<th>Amount pending</th>
			<th>Email Id</th>
			<th></th>
			
		</strong>
		</tr>
	<?php
		while($row = pg_fetch_row($result)){
			echo "<tr>";
			echo "<td>".$row[0]."</td>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "<td>".$row[5]."</td>";
			echo "<td>".$row[6]."</td>";
			echo"<td ><form action='/UI/DOMAINS/domain_head/Edit_vol/editVolunteer.php'>
					<input type='hidden' value='".$row[1]."' name='part_id'>
			<button type='submit' style='background-color: #b48387!important;border-color: #b48387!important;color:white;'>Edit</button></form></td>";
			echo "</tr>";
		}

	?>
	</table>
							
						</div>
					</header>

				<!-- Main -->
					

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

