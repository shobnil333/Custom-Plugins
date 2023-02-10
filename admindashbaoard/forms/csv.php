<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'session.php';
$filename = "report.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);


	$ref_url = "http:\\";

	$sqlscore = "SELECT aid, answer_text from wp_access_answer_master";

	$resultscore = $conn->query($sqlscore);
	if($resultscore)
	{
		while($rowscore = $resultscore->fetch_assoc()) 
		{
			$aid = $rowscore["aid"];
			$ans_arr[$aid] = $rowscore["answer_text"];
		}
	}

    $qtntext="";
    $u_status=0;

    $resultCSV = "Response ID, Date Submitted, Last Page,TY Page Returned, Date Started, Date Last Action, IP Address, Referrer URL, Videos Viewed";

	$sqlscore = "SELECT qid, questions from wp_access_question_master";

	$resultscore = $conn->query($sqlscore);
	if($resultscore)
	{
		while($rowscore = $resultscore->fetch_assoc()) 
		{
			$qid = $rowscore["qid"];
			$q_arr[$qid] = $rowscore["questions"];
			$qtntext.=',"'.$rowscore["questions"].'"';
			$resultCSV .= ",\"".$rowscore["questions"]."\"";
		}
	}


	$resultCSV .= ", Postal Code, Patient's Name, Email Address, Phone Number, Date of Onset";
    $resultCSV .= "\n";

	$sqlscore = "SELECT * from wp_access_user_master";

	$resultscore = $conn->query($sqlscore);
	if($resultscore)
	{
		while($rowscore = $resultscore->fetch_assoc()) 
		{

			
			$userid = $rowscore["uid"];
			$u_status = $rowscore["u_status"];
			$u_name = $rowscore["u_name"];
			$u_phone = $rowscore["u_phone"];
			$u_email = $rowscore["u_email"];
			$onset_date = $rowscore["onset_date"];
			$u_postalcode = $rowscore["u_postalcode"];
			$start_time = $rowscore["start_time"];
			$end_time = $rowscore["end_time"];
			$ip_address = $rowscore["ip_address"];
			$viewd_vidos = $rowscore["viewd_vidos"];

			$video_viewed = "";
			$str_vid_arr = explode(",", $viewd_vidos);
			foreach($str_vid_arr as $video) {
				if ($video=="1") {
					$video_viewed.="MOA Video ";
				}
				if ($video=="2") {
					$video_viewed.="Our Process Video ";
				}
				if ($video=="3") {
					$video_viewed.="Rosa Testimonial Video ";
				}
			}

			$thankyoupage="0";

			if ($u_status>=4) {
				$last_page = "11";

				if ($u_status==4) {
					$thankyoupage="2";
				} elseif ($u_status==5) {
					$thankyoupage="3a";
				} elseif ($u_status==6) {
					$thankyoupage="3b";
				}
			} else {
				$last_page=0;

				$sqllastpg = "SELECT IFNULL(max(qid),0) as max_qid FROM `wp_access_user_answers` where uid=$userid";

				$resultlastpg = $conn->query($sqllastpg);
				if($resultlastpg)
				{
					while($rowlastpg = $resultlastpg->fetch_assoc()) 
					{
						$last_page = $rowlastpg["max_qid"];
					}
				}
			}

			$resultCSV .= $userid.',"'.$end_time.'","'.$last_page.'","'.$thankyoupage.'","'.$start_time.'","'.$end_time.'","'.$ip_address.'","'.$ref_url.'","'.$video_viewed.'"';

			$sqltxtval = "SELECT a.qid,a.questions,b.aid FROM `wp_access_question_master` a left join `wp_access_user_answers` b on a.qid=b.qid and b.uid=$userid order by qorder";

			$k=0;

			$resulttxtval = $conn->query($sqltxtval);
			
			if($resulttxtval)
			{
				while($rowtxtval = $resulttxtval->fetch_assoc()) 
				{
					$k++;
					$answerwrite="";

					if ($rowtxtval["aid"]!='') {
						$str_arr = explode(",", $rowtxtval["aid"]);
						foreach($str_arr as $aid_value) {
							$anstxt_value = $ans_arr[$aid_value];

							if ($answerwrite=="") {
									$answerwrite=''.$anstxt_value.'';
							} else {
								$answerwrite.=','.$anstxt_value.'';
							}
						}
					}
					$resultCSV .= ',"'.$answerwrite.'"';
				}
			}
		$resultCSV .= ",".$u_postalcode.',"'.$u_name.'","'.$u_email.'","'.$u_phone.'","'.$onset_date.'"';
		$resultCSV .= "\n";
		}
}
echo $resultCSV;
exit();
?>
