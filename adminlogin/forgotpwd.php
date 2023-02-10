<?php
session_start();
include '../../connection.php';
$conn=mysqli_connect($_SERVERNAME,$_USERNAME,$_PASSWORD);
mysqli_select_db($conn,$_DBNAME);
 
$username=$_POST["username"];

$userq=mysqli_query($conn,"select * from admin_master where email='".$username."'");
//echo "select * from users where userid='".$username."' and password='".$password."'"; 
$numrows=mysqli_num_rows($userq);
mysqli_close($conn);
if($numrows>0)
{
	$data=mysqli_fetch_array($userq);


	$to = $username;
	$subject = "gecbventures.com - Your Password";

	$message = "
	<html>
	<head>
	<title>gecbventures.com</title>
	</head>
	<body>
	<p>Your password is ".$data["password"]." </p>
	</body>
	</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <admin@gecbventures.com>' . "\r\n";

	mail($to,$subject,$message,$headers);

	
	?>
		<script type="text/javascript">
		<!--
			alert('We have sent the password to your email. Please verify.');
			location.href="index.html";
			//return false;
		//-->
		</script>
	<?php
	
} else {
	?>
		<script type="text/javascript">
		<!--
			alert('Invalid email');
			location.href="index.html";
			//return false;
		//-->
		</script>
	<?php
}						
?>