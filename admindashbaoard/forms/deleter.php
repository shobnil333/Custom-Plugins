<?php
session_start();
echo "Deleting...";
include '../../../connection.php';
include '../../../db.php';
include 'session.php';

$score=$_GET["score"];

if($score=="" || $score<0) {
	echo "Invalid request";
	exit;
}

$q=mysqli_query($conn,"delete from result_text_tbl where max_score=$score");

echo "<br> deleted.";
mysqli_close($conn);

?>


<script type="text/javascript">
<!--
	alert('Deleted successfully');
	location.href="resultreport.php";
	//return false;
//-->
</script>
