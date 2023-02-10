<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'header.php';
include 'session.php';
$dId="";
$userid=$_SESSION['adminuserid'];

?>
<script type="text/javascript">
<!--

function searchId() {
	
	document.frm1.action="adminreport.php";
	document.frm1.submit();
}

//-->
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
                  <h4 class="card-title ">List of Admin</h4>
                  <!-- <p class="card-category"> Level 1</p>
 -->                </div>
				<div class="card-body">
					<div class="tree">
						<div class="card-body">
						  <div class="table-responsive">
							<table class="table" cellpadding=0>
							<thead>
							<tr>
								<!-- <th>Sl No</th> -->
								<th>Login ID</th>
								<th>Admin Name</th>
								<th>Password</th>
								<th>Email</th>
							</tr>
							
							</tr>
								</thead>
								<tbody>

								<?php


								$sQry = "SELECT * from admin_master";

								//echo $sQry;

								$result = mysqli_query($conn,$sQry);
								
								$row_cnt = mysqli_num_rows($result);
								$i = $row_cnt;
								

								if($result)
								{
									while ( $rows = mysqli_fetch_array($result) )
									{

										
										?>
										<tr>
										<!-- <td nowrap><?php echo $i; ?></td> -->
										<td nowrap><?php echo $rows["admin_id"]; ?></td>
										<td nowrap><?php echo $rows["username"]; ?></td>
										<td nowrap><?php echo $rows["password"]; ?></td>
										<td nowrap><?php echo $rows["email"]; ?></td></tr>
									<?php
									$i--;
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
