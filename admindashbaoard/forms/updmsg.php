<?php
session_start();
echo "Saving...";
include '../../../connection.php';
include '../../../db.php';

$totalrows=$_POST["totalrows"];

for($i=1; $i <= $totalrows; $i++) {
$settings_id=$_POST["settings_id".$i];
$settings_txt=mysqli_real_escape_string($conn,$_POST["settings_txt".$i]);
	$q=mysqli_query($conn,"update wp_access_msg_settings set settings_txt = '".$settings_txt."' where settings_id=$settings_id");
}

//exit;
echo "<br> Completed.";

mysqli_close($conn);

?>


<script type="text/javascript">
<!--
	alert('Updated successfully');
	location.href="msg_settings.php";

-->
</script>
