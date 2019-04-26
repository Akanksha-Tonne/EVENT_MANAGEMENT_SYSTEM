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
 		$result = pg_query("select * from event where  ecoord_id= '".$_SESSION['userid']."';");
 		$row = pg_fetch_row($result);
 		$ecoord_name = $row[4];
 		$ename = $row[2];
 		$fname=$row[9];
 		$result = pg_query("select * from volunteer join works_for on vid = vid_fk where ename_fk='".$ename."' and fname_fk_v = '".$fname."';");
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
      .btn-success{
      	background-color: #b48387!important;
      	border-color: #b48387!important;
      }
    </style>
	</head>
	<body>

		<!-- Wrapper -->
		<nav class="navbar sticky-top navbar-light bg-light" style="width:100%;">
				  <span class="navbar-brand colo mb-0 h1"><a href="/UI/EVENT/event_head/events.php">Home</a></span>
				  <span class="navbar-brand colo "><a href="/UI/Login_v4/index.php">Logout</a></span>
		</nav>
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<span class="avatar"><img src="images/avatar.jpg" alt="" /></span>
						<h1><?php echo $ename; ?><br><strong><?php echo $ecoord_name; ?><br></strong><?php echo$_SESSION['userid']; echo '<br>'.$fname;?><br /></h1>
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
			<th> </th>
			
		</strong>
		</tr>
	<?php
		while($row = pg_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>".$row['vname']."</td>";
			echo "<td>".$row['vid']."</td>";
			echo "<td>".$row['vphone']."</td>";
			echo "<td>".$row['total_amt']."</td>";
			echo "<td>".$row['amt_spent']."</td>";
			echo "<td>".$row['amt_due']."</td>";
			echo "<td>".$row['vemail_id']."</td>";
			echo"<td ><form action='/UI/EVENT/event_head/Edit_vol/editVolunteer.php'>
					<input type='hidden' value='".$row['vid']."' name='part_id'>
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


	</body>
</html>

