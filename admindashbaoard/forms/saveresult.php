<?php
session_start();
echo "Saving...";
include '../../../connection.php';
include '../../../db.php';

$maxscore=$_POST["maxscore"];
$resultext=mysqli_real_escape_string($conn,$_POST["resultext"]);

$userq=mysqli_query($conn,"insert into result_text_tbl (`max_score`, `result_text`) values ('".$maxscore."','".$resultext."')  ON DUPLICATE KEY UPDATE `result_text` = '".$resultext."'");
mysqli_close($conn);

?>

<script type="text/javascript">
<!--
	alert('Successfully updated into database');
	location.href="resultreport.php";
	//return false;
//-->
</script>
