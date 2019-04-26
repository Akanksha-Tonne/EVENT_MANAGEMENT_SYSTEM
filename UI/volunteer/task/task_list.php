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
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

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
							<section class="thumbnails">
								<div class="list">
									<?php
												$result2 = pg_query("select task_id,task_date,task_name,purpose,status,task_venue from task where task_id in(select task_id_fk from people_involved where task_pid='".$_SESSION['userid']."' );");
						
												echo"<table style='font-size:20px;text-align:left;' class='table-bordered table-hover'>
						                                <tr>
						                                	<strong>
						                                                <th>Task ID</th>
						                                                <th>Task Date</th>
						                                                <th>Task Name</th>
						                                                <th>Purpose</th>
						                                                <th>Status</th>
						                                                <th>Task Venue</th>
						                                	</strong>
						                                </tr>";
						                    	 while($row=pg_fetch_row($result2) )
												{
						                                echo" <tr>
		                                                 <td>".$row[0]."</td>
		                                                 <td>".$row[1]."</td>
		                                                 <td>".$row[2]."</td>
		                                                 <td>".$row[3]."</td>
		                                                 <td>".$row[4]."</td>
		                                                 <td>".$row[5]."</td>
		                                                 </tr>";
													
												}
												echo"</table>";
										
								?>
								</div>
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


 

