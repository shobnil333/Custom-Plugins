<?php
session_start();
echo "Saving...";
include '../../../connection.php';
include '../../../db.php';
include 'session.php';

$totalRows=$_POST["totalrows"];


for ($x = 1; $x <= $totalRows; $x++) {
	$qid=$_POST["qid".$x];
	$orderno=$_POST["orderno".$x];
	mysqli_query($conn,"UPDATE `question_master` SET `q_order`=$orderno WHERE `qid`=$qid");
}
mysqli_close($conn);
?>

<script type="text/javascript">
<!--
	alert('Updated successfully');
	location.href="questions.php";
	
	//return false;
//-->
</script>
