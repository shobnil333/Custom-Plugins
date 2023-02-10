<?php
session_start();
echo "Deleting...";
include '../../../connection.php';
include '../../../db.php';
include 'session.php';

$totalRows=$_POST["totalrows"];


for ($x = 1; $x <= $totalRows; $x++) {
	if(isset($_POST["check".$x])){
		$uid=$_POST["uid".$x];
		mysqli_query($conn,"delete from `wp_access_user_master` WHERE `uid`=$uid");
		mysqli_query($conn,"delete from `wp_access_user_answers` WHERE `uid`=$uid");
	}
}
mysqli_close($conn);
?>

<script type="text/javascript">
<!--
	alert('Deleted successfully');
	location.href="userreport.php";
	//return false;
//-->
</script>
