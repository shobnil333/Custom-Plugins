<?php
session_start();

include '../../connection.php';
$conn=mysqli_connect($_SERVERNAME,$_USERNAME,$_PASSWORD);
mysqli_select_db($conn,$_DBNAME);
 
$username=$_POST["username"];
$password=$_POST["pass"];

$userq=mysqli_query($conn,"select * from admin_master where admin_id='".$username."' and password='".$password."'");
//echo "select * from users where userid='".$username."' and password='".$password."'"; 
$numrows=mysqli_num_rows($userq);
mysqli_close($conn);
if($numrows>0)
{
	$data=mysqli_fetch_array($userq);
	$_SESSION["adminuserid"]=$data["admin_id"];
	$_SESSION["adminusername"]=$data["username"];
	$_SESSION["email"]=$data["email"];

	?>
		<script type="text/javascript">
		<!--
			//alert('success');
			location.href="../admindashboard/forms/index.php";
			//return false;
		//-->
		</script>
	<?php
	
} else {
	?>
		<script type="text/javascript">
		<!--
			alert('Invalid User Name and Password');
			location.href="index.php";
			//return false;
		//-->
		</script>
	<?php
}						
?>