<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    gecbventures.com - Change Password
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

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
                  <h4 class="card-title">Change Password</h4>
                </div>
                <div class="card-body">
                  <form action="savepwd.php" onsubmit="document.getElementById('btn').disabled=true;" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">New Password</label>
                          <input type="password" class="form-control"  name="password" required >
                        </div>
                      </div>
                    </div>
                    <button type="submit" id="btn" class="btn btn-primary pull-right">Change Password</button>
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
