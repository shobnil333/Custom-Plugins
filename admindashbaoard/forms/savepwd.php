<?php
session_start();
echo "Saving...";
include '../../../connection.php';
include '../../../db.php';

$password=$_POST["password"];

$userq=mysqli_query($conn,"update admin_master set password='".$password."' where admin_id=".$_SESSION["adminuserid"]);
echo "<br> Completed.";

mysqli_close($conn);

?>


<script type="text/javascript">
<!--
	alert('Updated password');
	location.href="adminreport.php";
	//return false;
//-->
</script>
