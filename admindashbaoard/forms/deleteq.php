<?php
session_start();
echo "Deleting...";
include '../../../connection.php';
include '../../../db.php';
include 'session.php';

$qid=$_GET["qid"];

if($qid=="" || $qid<=0) {
	echo "Invalid request";
	exit;
}
$q=mysqli_query($conn,"delete from wp_access_question_master where qid=$qid");
//$q=mysqli_query($conn,"delete from advice_master where qid=$qid");
//$q=mysqli_query($conn,"delete from `question_answer_map_tbl` where qid=$qid");

echo "<br> deleted.";
mysqli_close($conn);

?>


<script type="text/javascript">
<!--
	alert('Deleted successfully');
	location.href="questions.php";
	//return false;
//-->
</script>
