<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'session.php';

$userid=$_GET["id"];


	$message="";

	$message= $message. '<p>Candidacy Questionnaire</p><br>';


	$sql = "SELECT * from wp_access_user_master where uid=$userid";

	$result = mysqli_query($conn,$sql);

	if($result)
	{
		while ( $rows = mysqli_fetch_array($result) )
		{

			$viewd_vidos = $rows["viewd_vidos"];

			$video_viewed = "";
			$str_vid_arr = explode(",", $viewd_vidos);
			foreach($str_vid_arr as $video) {
				if ($video=="1") {
					$video_viewed.="MOA Video<br>";
				}
				if ($video=="2") {
					$video_viewed.="Our Process Video<br>";
				}
				if ($video=="3") {
					$video_viewed.="Rosa Testimonial Video<br>";
				}
			}


			$u_name = $rows["u_name"];
			$u_phone = $rows["u_phone"];
			$u_email = $rows["u_email"];
			$onset_date = $rows["onset_date"];
			$u_postalcode = $rows["u_postalcode"];
			$start_time = $rows["start_time"];
			$end_time = $rows["end_time"];
			$ip_address = $rows["ip_address"];
	        $u_status = $rows["u_status"];
		}
	}

    $thankyoupage="";
    
    if ($u_status == "4") {
        $thankyoupage="Postponed";        
    } else if ($u_status == "5") {
        $thankyoupage="Prime";        
    } else if ($u_status == "6") {
        $thankyoupage="Prime #MRI";        
    }
    

	$sql = "SELECT aid, answer_text from wp_access_answer_master";
	$result = mysqli_query($conn,$sql);

	if($result)
	{
		while ( $rows = mysqli_fetch_array($result) )
		{
			$aid = $rows["aid"];
			$ans_arr[$aid] = $rows["answer_text"];
		}
	}

	
	$sql = "SELECT count(1) as cnt from `wp_access_user_answers` where uid=$userid";

	$result = mysqli_query($conn,$sql);

	$page=0;

	if($result)
	{
		while ( $rows = mysqli_fetch_array($result) )
		{
			$page = $rows["cnt"];
		}
	}
	
	$message= $message. '<table><tr><td><b>Response ID</b></td><td>'.$userid.'</td></tr><tr><td><b>Date Submitted</b></td><td>'.$end_time.'</td></tr><tr><td><b>Last Page</b></td><td>'.$page.'</td></tr><tr><td><b>Date Started</b></td><td>'.$start_time.'</td></tr><tr><td><b>Date Last Action</b></td><td>'.$end_time.'</td></tr><tr><td><b>IP Address</b></td><td>'.$ip_address.'</td></tr><tr><td><b>TY Page Returned</b></td><td>'.$thankyoupage.'</td></tr><tr><td><b>Referrer URL</b></td><td></td></tr></table><br><br><b>Videos Viewed</b><br>'.$video_viewed.'<br>';


	$i=0;
	$sql = "SELECT a.qid,a.questions,b.aid FROM `wp_access_question_master` a left join `wp_access_user_answers` b on a.qid=b.qid and b.uid=$userid order by qid";

	$result = mysqli_query($conn,$sql);

	if($result)
	{
		while ( $rows = mysqli_fetch_array($result) )
		{
			$i=$i+1;
			$message= $message. '<br><div><b>'.$i.'. '.$rows["questions"].'</b></div>';
			if ($rows["aid"]!='') {
				$str_arr = explode (",", $rows["aid"]);
				foreach($str_arr as $aid_value) {
					$anstxt_value = $ans_arr[$aid_value];
					$message = $message. '<div>'.$anstxt_value.'</div>';
				}
			}
		}
	}

	$message= $message. '<br><div><b>'.($i+1).'. Eligible patients will be assigned a spine surgeon based on availability and proximity. Please enter the first 3 digits of your postal code and click "Submit" to discover whether you&apos;re eligible and learn the identity and location of your surgeon.</b></div><div>'.$u_postalcode.'</div><br><br><table><tr><td><b>Patient&apos;s Name</b></td><td>'.$u_name.'</td></tr><tr><td><b>Email Address</b></td><td>'.$u_email.'</td></tr><tr><td><b>Phone Number</b></td><td>'.$u_phone.'</td></tr><tr><td><b>Date of Onset</b></td><td>'.$onset_date.'</td></tr></table>';

	$headers = array(
		'Content-Type: text/html; charset=UTF-8'
	);

echo $message;


?>
