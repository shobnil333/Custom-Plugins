<?php
session_start();
echo "Saving...";
include '../../../connection.php';
include '../../../db.php';
include 'session.php';

$question=mysqli_real_escape_string($conn,$_POST["question"]);
$totalrows=$_POST["totalrows"];
$followup=$_POST["followup"];
$questiontype=$_POST["questiontype"];

$order_=1;

if($followup==1) {
	$order_=0;
} else {		
	$sqlAns = "SELECT IFNULL(max(`qorder`),0) + 1  as qorder FROM `wp_access_question_master` WHERE 1";
	//echo $sqlAns;
	$resultsAns = $conn->query($sqlAns);
	while($row = $resultsAns->fetch_assoc()) {
		$order_=$row["qorder"];
	}
}

$q=mysqli_query($conn,"insert into wp_access_question_master (questions,qorder,	followup_flag,q_type,status,condition_text) values ('".$question."',$order_,'".$followup."','".$questiontype."',1,'')");
$newqid = mysqli_insert_id($conn);
if($newqid>0) {
	for($i=0; $i < $totalrows; $i++) {

		$answertext=mysqli_real_escape_string($conn,$_POST["answertext".$i]);
$followup=0;
if($_POST["followupans".$i]!="") {
	$followup=$_POST["followupans".$i];
}


		if($i==0) {
			$sql="('".$newqid."', '".$answertext."', '".($i+1)."', $followup)";
		} else {
			$sql=$sql.",('".$newqid."', '".$answertext."', '".($i+1)."', $followup)";
		}
	}
	mysqli_query($conn,"INSERT INTO `wp_access_answer_master` (`qid`, `answer_text`,`answer_order`,`followup_qtn`) VALUES ".$sql."");
}

echo "<br> Completed.";
mysqli_close($conn);

?>


<script type="text/javascript">
	alert('New question added successfully');
	location.href="questions.php?newqid=<?php echo $newqid?>";
	//return false;
</script>
