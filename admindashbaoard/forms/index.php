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
	  <?php
	  //Fetch Wallet 
		$user_count=0;
		$sql = "SELECT count(1) as user_count from `wp_access_user_master` a where 1 ";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) {
			$user_count=$row["user_count"];
		}

		$fromDate=date('Y-m-d', strtotime("-1 day"));
		$toDate=date('Y-m-d', strtotime("0 day"));


		$newusers=0;
		$sql = "SELECT count(1) as new_user from `wp_access_user_master` a where 1=1 and DATE(a.end_time) >= '".$fromDate."' and DATE(a.end_time) <= '".$toDate."' ";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) {
			$newusers=$row["new_user"];
		}
	
	  ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>
                  <p class="card-category">Total Users</p>
                  <h3 class="card-title"><small></small><?php echo $user_count; ?>
                  </h3>
                </div>
				 <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Just Updated
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>
                  <p class="card-category">New Users</p>
                  <h3 class="card-title"><?php echo $newusers; ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Just Updated
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
