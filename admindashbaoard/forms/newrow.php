<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'session.php';
?>
<?php
$rownum=$_GET["rownum"];
?>
	<div class="row" id="surveyrow<?php echo $rownum; ?>">
		<div class="col-sm-3">
			<div class="form-group">
			<input type="text" name="answertext<?php echo $rownum; ?>" class="form-control" value="" required>
			</div>
		</div>
		<div class="col-sm-7">	  
				<select name="followupans<?php echo $rownum; ?>"   id="followupans<?php echo $rownum; ?>"  class="form-control" style="width:100%;height:100%;">
					<option value="" selected>--No Followup Question--
						<?php
							$sqlm = "SELECT qid, questions from wp_access_question_master where followup_flag=1 and qid not in (select followup_qtn from wp_access_answer_master) order by questions";

							$resultm = $conn->query($sqlm);
							while($rowm = $resultm->fetch_assoc()) 
							{
								$qid = $rowm["qid"];
								$questions = $rowm["questions"];
						?>
							<option value="<?php echo $qid ?>" > <?php echo $questions; ?></option>
						<?php
							}
						?>

				</select>
		</div>
		<div class="col-sm-2">	  
				 <a href="#a" onclick="deleterow(<?php echo $rownum; ?>)">X</a>
		</div>
	</div>
