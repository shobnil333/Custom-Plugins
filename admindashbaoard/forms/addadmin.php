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
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add New Admin</h4>
                  <p class="card-category">Fill all the mandatory columns</p>
                </div>
                <div class="card-body">
                  <form action="saveadmin.php" onsubmit="document.getElementById('btn').disabled=true;" method="post">
                    <div class="row">                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">*Name</label>
                          <input type="text" class="form-control" name="username" id="username" required pattern="[a-zA-Z][a-zA-Z ]{2,}" >
                        </div>
                      </div>                     
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">*Email</label>
                          <input type="email" class="form-control"  name="email" required >
                        </div>
                      </div>
                    </div>
                    <button type="submit" id="btn" class="btn btn-primary pull-right">Save Admin</button>
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
