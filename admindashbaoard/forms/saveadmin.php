<?php
session_start();
echo "Saving...";
include '../../../connection.php';
include '../../../db.php';

$username=$_POST["username"];
$email=$_POST["email"];

//$password=rand(10000,99999);
$password="20202020";

$userq=mysqli_query($conn,"insert into admin_master (username,email,password) values ('".$username."','".$email."','".$password."')");
$newuserid = mysqli_insert_id($conn);

echo "<br> New user id ". $newuserid;

echo "<br> Completed.";

mysqli_close($conn);

?>


<script type="text/javascript">
<!--
	alert('New user Id <?php echo $newuserid; ?> ');
	location.href="adminreport.php";
	//return false;
//-->
</script>
