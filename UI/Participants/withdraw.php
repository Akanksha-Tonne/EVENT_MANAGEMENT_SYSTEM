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
<?php
$ename = $_POST['event'];
pg_query("DELETE FROM PARTICIPATES_IN WHERE Reg_id_fk='".$p_reg_id."' AND ENAME_FK='".$ename."';");
?>
<script type="text/javascript">
      location.href = "participants.php";
</script>
