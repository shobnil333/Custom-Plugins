<?php
session_start();
echo "Saving...";
include '../../../connection.php';
include '../../../db.php';
include 'session.php';

$qid=$_POST["qid"];
$totalRows=$_POST["totalRows"];


for ($x = 1; $x <= $totalRows; $x++) {
	$aid=$_POST["aid".$x];
	$advice=$_POST["advice".$x];

	mysqli_query($conn,"INSERT INTO advice_master (`qid`, `aid`, `advice_content`) VALUES ($qid,$aid,'$advice') ON DUPLICATE KEY UPDATE `advice_content` = '$advice'");

}



mysqli_close($conn);

?>


<script type="text/javascript">
<!--
	window.opener.location.reload()
	alert('Saved successfully');
	window.close();
	//return false;
//-->
</script>
