<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'header.php';
include 'session.php';

$score="";
$result_text="";

if(isset($_GET["score"])) {
	$score = $_GET["score"];
	$sQry = "SELECT result_text from result_text_tbl where max_score=$score";
	$result = mysqli_query($conn,$sQry);								
	while ( $rows = mysqli_fetch_array($result) )
	{
		$result_text = $rows["result_text"];
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
                  <h4 class="card-title">Add New</h4>
                  <p class="card-category">Fill all the mandatory columns</p>
                </div>
                <div class="card-body">
                  <form action="saveresult.php" onsubmit="document.getElementById('btn').disabled=true;" method="post">
                    <div class="row">                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">*Score</label>
                          <input type="number" class="form-control" name="maxscore" id="maxscore" required value="<?php echo $score; ?>">
						  <small id="" class="form-text text-muted">Enter the maximum number</small>
                        </div>
                      </div>                     
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">*Result Text</label>
                          <textarea class="form-control"  name="resultext" required rows=5 ><?php echo $result_text; ?></textarea>
                        </div>
                      </div>
                    </div>
                    <button type="submit" id="btn" class="btn btn-primary pull-right">Save Result</button>
                  </form>
                </div>
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
