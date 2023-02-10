<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'header.php';
include 'session.php';
$userid=$_SESSION['adminuserid'];
?>

<script>
	function editr(score) {
		location.href='addresult.php?score='+score;
	}

	function deleter(score) {
		location.href='deleter.php?score='+score;
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
                  <h4 class="card-title ">Result Text Configuration</h4>
                  <!-- <p class="card-category"> Level 1</p>
 -->                </div>
				<div class="card-body">
					<div class="tree">
						<div class="card-body">
						  <div class="table-responsive">
							<table class="table" cellpadding=0>
							<thead>
							<tr>
								<th>Edit</th>
								<th>Maximum Score</th>
								<th>Result Text</th>
								<th>Delete</th>
							</tr>
							
							</tr>
								</thead>
								<tbody>

								<?php

								$sQry = "SELECT * from result_text_tbl order by max_score";
								$result = mysqli_query($conn,$sQry);								

								if($result)
								{
									while ( $rows = mysqli_fetch_array($result) )
									{

										
										?>
										<tr>
											<td nowrap><input type="button" class="btn btn-primary" value="Edit" onclick="editr(<?php echo $rows["max_score"]; ?>)"></td>
											<td nowrap><?php echo $rows["max_score"]; ?></td>
											<td ><?php echo $rows["result_text"]; ?></td>
											<td nowrap><input type="button" class="btn btn-warning" value="Delete" onclick="if(confirm('Are you sure to delete? '))deleter(<?php echo $rows["max_score"]; ?>); "></td>
										</tr>
									<?php
									}
								}

								?>
								</tbody>
								<thead>
									<tr>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
							</table>

		</div>
	  <?php
		  include '../component/footer.html';
	  ?>
    </div>
  </div>
</body>

</html>
