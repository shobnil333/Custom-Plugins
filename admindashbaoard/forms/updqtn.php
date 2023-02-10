<?php
session_start();
echo "Saving...";
include '../../../connection.php';
include '../../../db.php';

$question=mysqli_real_escape_string($conn,$_POST["question"]);
$qid=$_POST["qid"];
$totalrows=$_POST["totalrows"];

$q=mysqli_query($conn,"update wp_access_question_master set questions = '".$question."' where qid=$qid");

for($i=1; $i <= $totalrows; $i++) {
	//echo $i."<br>";
	$aid=$_POST["aid".$i];
	$answer_text=$_POST["answer_text".$i];
	//echo $answer_text."<br>";
	//echo "update wp_access_answer_master set answer_text = '".$answer_text."' where aid=$aid";
	
	if($aid!="") {
		if(trim($answer_text)!="") {
			$q=mysqli_query($conn,"update wp_access_answer_master set answer_text = '".$answer_text."' where aid=$aid");
		} else {
			$q=mysqli_query($conn,"delete from wp_access_answer_master where aid=$aid");
		}
	} else {
		if($answer_text!="") {
			$sql="('".$qid."', '".$answer_text."', '".$i."', 0)";
			mysqli_query($conn,"INSERT INTO `wp_access_answer_master` (`qid`, `answer_text`,`answer_order`,`followup_qtn`) VALUES ".$sql."");
		}
	}

}

echo "<br> Completed.";

mysqli_close($conn);

?>


<script type="text/javascript">
<!--
	alert('Updated successfully');
	location.href="editq.php?qid=<?php echo $qid?>";
-->
</script>
