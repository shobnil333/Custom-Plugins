<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'session.php';
$filename = "planup report.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

$resultCSV = "Id, Date";

$sqlscore = "SELECT * from planup_question_master order by qid asc";

	$resultscore = $conn->query($sqlscore);
	if($resultscore)
	{
		while($rowscore = $resultscore->fetch_assoc()) 
		{
			$resultCSV .= ",".$rowscore["question"];
		}
	}

$sqlscore = "SELECT aid, answer_text,other_flag from planup_answer_master";
$resultscore = $conn->query($sqlscore);
if($resultscore)
{
	while($rowscore = $resultscore->fetch_assoc())
	{
		$aid = $rowscore["aid"];
		$ans_arr[$aid] = $rowscore["answer_text"];
		$ans_oth_flag_arr[$aid] = $rowscore["other_flag"];
	}
}

//print_r($ans_oth_flag_arr);

$resultCSV .= "\n"; 
$sqlm = "SELECT `uid`, `created_date` FROM `planup_user_master`";


$resultm = $conn->query($sqlm);

if($resultm)
{
	while($rowm = $resultm->fetch_assoc()) 
	{
		$uid = $rowm["uid"];
		
		$report_date = substr($rowm["created_date"],0,10);

		$resultCSV .= $uid.',"'.$report_date.'"';

		$sqlscore = "SELECT a.qid,b.aid,b.ans_text,qtype FROM `planup_question_master` a left join `planup_user_answers` b on a.qid=b.qid and b.uid=$uid order by qorder";
		$resultscore = $conn->query($sqlscore);
		if($resultscore)
		{
			while($rowscore = $resultscore->fetch_assoc()) 
			{
			$ans_text = $rowscore["ans_text"];
			$qtype = $rowscore["qtype"];
			$answerwrite="";
				
				if ($rowscore["aid"]!='') {
					$str_arr = explode(",", $rowscore["aid"]);
					foreach($str_arr as $aid_value) {
						$anstxt_value = $ans_arr[$aid_value];//6,
						if ($answerwrite=="") {
							$answerwrite=''.$anstxt_value.'';
						} else {
							$answerwrite.=','.$anstxt_value.'';
						}
					}
				}

				if ($answerwrite=="") {
					if ($qtype==4) {
						$answerwrite=intval($ans_text)*10;
					} else {
						$answerwrite=$ans_text;
					}
					
				} else {
					if (isset($ans_oth_flag_arr[$rowscore["aid"]]) && $ans_oth_flag_arr[$rowscore["aid"]]==2) {
						$answerwrite =$ans_text." - ".$answerwrite;
					} else {
						if ($ans_text!="") {
							$answerwrite .=','.$ans_text.'';
						}
					}
				}				

				$resultCSV .= ',"'.$answerwrite.'"';
			}
		}
		$resultCSV .= "\n"; 
	}
}

echo $resultCSV;
?>
