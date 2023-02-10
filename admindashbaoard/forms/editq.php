<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'header.php';
include 'session.php';

$qid="";
if($_GET) {
	$qid=$_GET["qid"];
} else {
	echo "Invalid request";
	exit;
}


$sQry = "SELECT `qid`, `questions` FROM `wp_access_question_master` a WHERE `qid`=$qid";

$result = mysqli_query($conn,$sQry);

$row_cnt = mysqli_num_rows($result);
$i = 1;

$question="";
$followup=0;

if($result)
{
	while ( $rows = mysqli_fetch_array($result) )
	{
		$question = $rows["questions"];
	}
}



?>

<body class="">
  <div class="wrapper ">
    <?php
	  include '../component/sidenav.php';
	?>
    </div>
    <div class="main-panel">
      <?php
		  include '../component/nav.php';
	  ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Edit Questions</h4>
                  <p class="card-category">Fill all the mandatory columns</p>
                </div>
                <div class="card-body">
                  <form action="updqtn.php" onsubmit="document.getElementById('btn').disabled=true;" method="post">
                    <div class="row">                      
                      <div class="col-md-12">
                         <div class="form-group">
                          <label class="bmd-label-floating">*Question Text</label>
                          <input type="text" value="<?php echo $question;?>" class="form-control" name="question" required>
                          <input type="hidden" value="<?php echo $qid;?>" class="form-control" name="qid" required>
                       </div>
					  </div>
					 </div>


                    <div class="row">                      
                      <div class="col-md-12">
                         <div class="form-group">
                          <label class="bmd-label-floating">*Question Answers</label>

						<?php
						$sQry = "SELECT `aid`, `answer_text` FROM `wp_access_answer_master` a WHERE `qid`=$qid";

						$result = mysqli_query($conn,$sQry);

						$row_cnt = mysqli_num_rows($result);

						echo $row_cnt;
						$i = 1;

						$question="";
						$followup=0;

						if($result)
						{
							while ( $rows = mysqli_fetch_array($result) )
							{
								
								$answer_text = $rows["answer_text"];
								$aid = $rows["aid"];
								?>
								  <input type="text" value="<?php echo $answer_text;?>" class="form-control" name="answer_text<?php echo $i;?>" >
								  <input type="hidden" value="<?php echo $aid;?>" class="form-control" name="aid<?php echo $i;?>" >
					 			<?php
									$i++;
							}
						}

						$totalrows=$i+2;
						

						for ($k=$i;$k<=$totalrows;$k++) {
							?>
							  <input type="text" value="" class="form-control" name="answer_text<?php echo $k;?>" >
							  <input type="hidden" value="" class="form-control" name="aid<?php echo $k;?>" >
							<?php
						}

						?>
						<input type="hidden" name="totalrows" value="<?php echo $totalrows;?>">

                       </div>
					  </div>
					 </div>
                    <button type="submit" id="btn" class="btn btn-primary pull-right">Update Question</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <?php
		  include '../component/footer.html';
	  ?>
    </div>
  </div>
</body>

</html>