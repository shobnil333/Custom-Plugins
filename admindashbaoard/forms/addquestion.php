<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'header.php';
include 'session.php';
?>
<script>

	function addnewrow() {
		var newrow = $("#totalrows").val()
		$.get( "newrow.php", {rownum:newrow}, function( data ) {
				$("#answerdiv").append(data);
				var totalrow = parseInt($("#totalrows").val()) + 1
				$("#totalrows").val(totalrow);
		});
	}
	function deleterow(row) {
			$("#surveyrow"+row).remove();
	}

</script>
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add New Question</h4>
                  <p class="card-category">Fill all the mandatory columns</p>
                </div>
                <div class="card-body">
                  <form action="saveqtn.php" onsubmit="document.getElementById('btn').disabled=true;" method="post">
                    <div class="row">                      
                      <div class="col-md-12">
						<div class="form-group">
                          <label class="bmd-label-floating">* Question Text</label>
                          <input type="text" class="form-control" name="question" required>
                        </div>
					  </div>
					</div>

					<div class="row">
                      <div class="col-md-3">
						<div class="form-group"><label class="bmd-label-floating">* Question Type</label>
							  <select name="questiontype" id="questiontype"  class="form-control" onchange="ShowHideRules(this.value)" required >
								<option value="" > --Select Question Type-- 
								<option value="2">Radio Option
								<option value="1" >Check Box
							  </select>
						   </div>
						</div>
					</div>

					<div class="row">
                      <div class="col-md-6">
						<div class="form-group"><label class="bmd-label-floating">* Followup question?</label></div>
						<div class="col-md-6">
							  <label for="followupyes">
								<input type="radio" name="followup" required id="followupyes" value="1" > <span class="text-success">Yes</span> &nbsp;&nbsp;&nbsp;
							  </label>
								  <label for="followupno">
								<input type="radio" name="followup" required  checked id="followupno" value="0" > <span class="text-success">No</span> 
							  </label>
						</div>
					  </div>				  
					</div>

							  <div class="form-group" id="selectanswer"><label class="bmd-label-floating">* Select Answer</label>
							  <div id="answerdiv">
								<div class="row" id="answerdivrows">
									<div class="col-sm-3">	
										 Answer text &nbsp;&nbsp;<a href="#a" onclick="addnewrow()"><u><strong>Add New (+) </strong></u></a>
									</div>
									<div class="col-sm-7">	  
										Followup Question 
									</div>
									<div class="col-sm-2">	  
										Delete
									</div>
								</div>


							  </div>
							</div>		
							<input type="hidden" name="totalrows" id="totalrows" value=0>
							
							<button type="submit" id="btn" class="btn btn-primary pull-right">Save Question</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>	  <?php
		  include '../component/footer.html';
	  ?>
    </div>
  </div>
</body>

</html>
