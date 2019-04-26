<?php
 		$db_connection = pg_connect("host=localhost dbname=event_management user=postgres password=database");

?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Event Management</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body style="text-align: center;">

		
	<h1><strong>PES UNIVERSITY</strong></h1>
	<button style="background-color:#252946 !important; font-size:30px !important; color: white !important;"><a href="/ui/login_v4/index.php" >Login</a></button>
		

		<!-- Wrapper -->
			<div id="wrapper">

		<?php $result_f = pg_query("SELECT * FROM FEST;");
		$i=1;

			
			while($row_f = pg_fetch_row($result_f))
			{
				echo "

				<header id='header'>

						<span class='avatar'><img src='images/avatar".$i.".jpg'/></span>
						
					</header>

				<table style='font-size:20px;text-align:center;' class='table-bordered tabel-hover'>
				<caption style='font-size:30px;'>".$row_f[0]."</caption>
				<tr style='text-aling:center;'><strong>
				<th>Name</th>
				<th>Date</th>
				<th>Time</th>
				<th>Venue</th>
				<th>Coordinator</th>
				</strong>
				</tr>
				";
				$i = $i + 1;
				$result_e = pg_query("SELECT * FROM EVENT WHERE FNAME_FK='".$row_f[0]."';");
 				while($row_e = pg_fetch_row($result_e)){
				echo "<tr>";
				echo "<td>".$row_e[2]."</td>";
				echo "<td>".$row_e[1]."</td>";
				echo "<td>".$row_e[0]."</td>";
				echo "<td>".$row_e[3]."</td>";
				echo "<td>".$row_e[4]."</td>";
				echo "</tr>";
				}
				echo"</table><br>";
				$result_w = pg_query("SELECT PNAME, ENAME, W_REG_ID, PRIZE_MONEY, POSITION FROM (PARTICIPANTS JOIN(EVENT JOIN WINNER ON FNAME_FK='".$row_f[0]."' and ename=ename_fk) ON REG_ID=W_REG_ID);");
			echo "<table style='font-size:20px;text-align:center;' class='table-bordered tabel-hover'>
				<caption style='font-size:30px;'>".$row_f[0]."</caption>
				<tr style='text-aling:center;'><strong>
				<th>Name</th>
				<th>Event</th>
				<th>Registration Id</th>
				<th>Prize Money</th>
				<th>Position</th>
				</strong>
				</tr>
				";
				while($row_w = pg_fetch_row($result_w))
				{	
					echo "<tr>";
					echo "<td>".$row_w[0]."</td>";
					echo "<td>".$row_w[1]."</td>";
					echo "<td>".$row_w[2]."</td>";
					echo "<td>".$row_w[3]."</td>";
					echo "<td>".$row_w[4]."</td>";
					echo "</tr>";
				}
				echo"</table><br>";

			}


			
		?>

		<button style="background-color:#252946 !important; color: white !important;"><a href="/UI/home/registrations/reg_form.php">
		Register for an event!
		</a></button>
		

				<!-- Footer -->
					<footer id="footer">
						<p>&copy; Untitled. All rights reserved. Design: <a href="http://templated.co">TEMPLATED</a>. Demo Images: <a href="http://unsplash.com">Unsplash</a>.</p>
					</footer>

			</div>
	</body>
</html>

