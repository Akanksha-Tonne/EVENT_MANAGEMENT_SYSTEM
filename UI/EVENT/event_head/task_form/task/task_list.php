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
						 		$row = pg_fetch_row($result);
						 		$ecoord_name = $row[4];
						 		$ename = $row[2];
						 		$fname=$row[9];

               }

?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Visualize by TEMPLATED</title>
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
		<nav class="navbar sticky-top navbar-light bg-light" style="width:100%;">
				  <span class="navbar-brand mb-0 h1"><a href="/UI/DOMAINS/domain_head/domains.php">Home</a></span>
				  <span class="navbar-brand"><a href="/UI/Login_v4/index.php">Logout</a></span>
		</nav>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<span class="avatar"><img src="images/avatar.jpg" alt="" /></span>
						<h1><?php echo $ename; ?><br><strong><?php echo $ecoord_name; ?><br></strong><?php echo$_SESSION['userid']; ?><br /></h1>
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
								$result = pg_query("select * from task where ename_fk='".$ename."';");
						?>
						
							<section class="thumbnails">
								<div class="list">
									<div>
									<a href="addTask.php"><h3>Add Task</h3></a>
									
								</div>
									<?php
										while ($row = pg_fetch_row($result)) 
										{
												echo"<a onclick='onclick',function()
															{	
																sessionStorage.setItem('task_id', '".$row[0]."');
															}>
															<h3>".$row[2]."</h3></a>";
															echo"<script>console.log('working')</script>";
												$result2 = pg_query("select vname,vid,vphone,vemail_id from volunteer join people_involved on vid=task_pid where task_id_fk='".$row[0]."';");
												echo"$row[0]";
												echo"<table style='font-size:20px;text-align:left;' class='table-bordered table-hover'>
						                                <tr>
						                                	<strong>
						                                                <th>Volunteer Id</th>
						                                                <th>Volunteer Name</th>
						                                                <th>Volunteer Phone</th>
						                                                <th>Email Id</th>
						                                	</strong>
						                                </tr>";
						                    	 while($row=pg_fetch_row($result2) )
												{
						                                echo" <tr>
		                                                 <td>".$row[0]."</td>
		                                                 <td>".$row[1]."</td>
		                                                 <td>".$row[2]."</td>
		                                                 <td>".$row[3]."</td>
		                                                 </tr>";
													
												}
												echo"</table>";
										}
								?>
								</div>
								<br>
								
								
							</section>

					</section>

				<!-- Footer -->
					<footer id="footer">
						<p>&copy; Untitled. All rights reserved. Design: <a href="http://templated.co">TEMPLATED</a>. Demo Images: <a href="http://unsplash.com">Unsplash</a>.</p>
					</footer>

			</div>




	</body>
</html>

























































<!-- No need of jquery libraries. -->

		<!-- Scripts -->
			<!-- <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/main.js"></script> -->
			<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<?php
//      To create an anchor tag with for each tuple of the element.
		
				



			// echo"<script>
			// 	$(document).ready(function(){

			// 		var div1 = document.createElement('div'); // outer div
			// 		$(div1).attr('style','display:inline-block');

			// 		var div3 = document.createElement('div');
			// 		var anchor = document.createElement('a');
			// 		$(anchor).attr('onclick',function()
			// 		{	
			// 			sessionStorage.setItem('task_id', '".$row[0]."');
			// 		})
			// 		$(anchor).attr('href','#')
			// 		var h3 = document.createElement('h3');
			// 		var txt =  '".$row[2]."'
			// 		h3.innerHTML = txt;
			// 		anchor.append(h3);
			// 		$(div3).append(anchor);
			// 		$(div1).append(div3);

			// 		var div2 = document.createElement('div');
			// 		var check = document.createElement('input');
			// 		$(check).attr('type','checkbox');
			// 		var status = '".$row[3]."'
			// 		if(status=='PENDING')
			// 		{
			// 			x='checked';
			// 		}
			// 		else
			// 		{
			// 			x='unchecked'
			// 		}
			// 		$(check).attr('value',x);
			// 		$(div2).append(check);
			// 		$(div1).append(div2);
			// 	  	$('.list').append(div1);
			// 	  });
			// </script>";
		
?>


 

