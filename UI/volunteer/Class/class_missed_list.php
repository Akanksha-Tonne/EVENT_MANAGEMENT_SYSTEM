<?php

               session_start();

               if (!(isset($_SESSION['userid'])))

               {

                               echo "<script>location.href='index.php'</script>";

               }

               else{
               	if($_SESSION['type'] != 'volunteer')
    			{
    				echo '<script>alert("Your are not authorized to view this page please login as Volunteer.");</script>';
      				echo "<script>location.href='/ui/login_v4/index.php'</script>";
				}

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
				  <span class="navbar-brand colo mb-0 h1"><a href="/UI/DOMAINS/domain_head/domains.php">Home</a></span>
				  <span class="navbar-brand colo "><a href="/UI/Login_v4/index.php">Logout</a></span>
		</nav>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<span class="avatar"><img src="images/avatar.jpg" alt="" /></span>
						<h1><?php echo $dname; ?><br><strong><?php echo $vname; ?><br></strong><?php echo$_SESSION['userid']; ?><br /></h1>
						<ul class="icons">
							<li><a href="#" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon style2 fa-500px"><span class="label">500px</span></a></li>
							<li><a href="#" class="icon style2 fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
					</header>

				<!-- Main -->
					<section id="main">

						<!-- Thumbnails -->
						<?php
								$result2 = pg_query("select * from class where vid_fk= '".$_SESSION['userid']."';");

						?>
						
							<section class="thumbnails" style="display:flex;justify-content: center;">
								<div class="list">
									<?php
										echo"<table style='font-size:20px;text-align:left;' class='table-bordered table-hover'>
											<caption style='font-size:20px;'><strong>Classes Missed</strong></caption>
						                                <tr>
						                                	<strong>
						                                                <th>Date</th>
						                                                <th>Time</th>
						                                                <th>Subject Code</th>
						                                               
						                                	</strong>
						                                </tr>";
						                    	 while($row=pg_fetch_row($result2) )
												{
						                                echo"<tr>
		                                                 <td>".$row[0]."</td>
		                                                 <td>".$row[1]."</td>
		                                                 <td>".$row[2]."</td>
		                                                 </tr>";
													
												}
												echo"</table>";
										
								?>
								</div>

							</section>
					</section>
					<section id="main">

						<!-- Thumbnails -->
							<section class="thumbnails">
								
									<a href="class_missed.php"><h3>Edit Classes Missed</h3></a>
						
								
							</section>

					</section>

				<!-- Footer -->
					<footer id="footer">
						<p>&copy; Untitled. All rights reserved. Design: <a href="http://templated.co">TEMPLATED</a>. Demo Images: <a href="http://unsplash.com">Unsplash</a>.</p>
					</footer>

			</div>




	</body>
</html>
