<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'header.php';
include 'session.php';
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Message Settings</h4>
                  <p class="card-category">Fill all the mandatory columns</p>
                </div>
                <div class="card-body">
                  <form action="updmsg.php" onsubmit="document.getElementById('btn').disabled=true;" method="post">

                    <div class="row">                      
                      <div class="col-md-12">
                         <div class="form-group">
                          <label class="bmd-label-floating">*Messages</label>

					<table class="table" cellpadding=0>
					<thead>
					<tr>
						<th width="5%">Sl No</th>
						<th width="15%">Setting Name</th>
						<th>Setting Text</th>
					</tr>
					</thead>
						<tbody>
						<?php
						$sQry = "SELECT `settings_id`, `settings_name`, `settings_txt` FROM `wp_access_msg_settings`";

						$result = mysqli_query($conn,$sQry);
						$row_cnt = mysqli_num_rows($result);
						$i = 0;

						$question="";
						$followup=0;

						if($result)
						{
							while ( $rows = mysqli_fetch_array($result) )
							{
								$i++;
								$settings_id = $rows["settings_id"];
								$settings_name = $rows["settings_name"];
								$settings_txt = $rows["settings_txt"];
								?>
								<tr>
									<td nowrap><?php echo $i; ?><input type="hidden" value="<?php echo $settings_id;?>" class="form-control" name="settings_id<?php echo $i;?>" required></td>
									<td nowrap><?php echo $settings_name;?></td>
									<td><input type="textarea" value="<?php echo $settings_txt;?>" class="form-control" name="settings_txt<?php echo $i;?>" required></td>
										
								</tr>
					 			<?php
							}
						}

						?>
						<input type="hidden" name="totalrows" value="<?php echo $i;?>">
						</tbody>
					<thead>
						<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th><button type="submit" id="btn" class="btn btn-primary">Update Message Settings</button></th>
						</tr>
					</thead>
				</table>



                       </div>
					  </div>
					 </div>

					
					
					
					
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