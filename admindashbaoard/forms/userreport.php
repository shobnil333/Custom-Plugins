<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'header.php';
include 'session.php';

$phone="";
$userid=$_SESSION['adminuserid'];
$fromDate=date('Y-m-d', strtotime("-30 day"));
$toDate=date('Y-m-d', strtotime("0 day"));
if($_GET) {
	$fromDate=$_GET["fromDate"];
	$toDate=$_GET["toDate"];
	$phone=$_GET["phone"];

}

?>
<script type="text/javascript">

function searchId() {
	document.frm1.action="userreport.php";
	document.frm1.submit();
}

function showresult(userid) {
	$userid=userid;
	window.open('indireport.php?id='+$userid+'');
}

function csv() {

	window.open('csv.php');

}

function deleteusers() {

	var atleastone=false;


	for (var i=1;i<=document.getElementById('totalrows').value;i++) {

		if(document.getElementById('check'+i).checked==true) {
			atleastone=true;
			break;
		}
	}

	if(atleastone) {
		document.frm2.submit();
	} else {
		alert('You have to select atleast one user to delete');
		return false;
	}
}




var flag=true;
function checkallval() {  

   $('input:checkbox').each(function(){
        $(this).prop('checked',flag);
   })
   if(flag) {
		flag=false;
   } else {
	   flag=true;
   }
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
                  <h4 class="card-title ">List of users</h4>
                  <!-- <p class="card-category"> Level 1</p>
 -->                </div>
				<div class="card-body">
					<div class="tree">
						<div class="card-body">
						  <div class="table-responsive">
							<h3 style="color:green;">
								<form name=frm1 method=get action="userreport.php"> 
									<div class="row">                      <!-- 
									  <div class="col-md-3">
										<div class="form-group">
										  <label class="bmd-label-floating">ID/Name/Mobile</label>
											<input type="text" size=20 class="form-control"  name="search" id="search" placeholder="UserID/Name/Mobile" value="<?php echo "";?>"							>
										 </div>
									  </div> -->
									  <div class="col-md-2">
										<div class="form-group">
										  <label class="bmd-label-floating">From Date</label>
											<input type="date" class="form-control" title="From Date." id="fromDate" name="fromDate" value="<?php echo $fromDate;?>" size=20 required >
										 </div>
									  </div>
									  <div class="col-md-2">
										<div class="form-group">
										  <label class="bmd-label-floating">To Date</label>
											<input type="date" title="To Date." id="toDate" name="toDate" value="<?php echo $toDate;?>" class="form-control" max="<?=date('Y-m-d', strtotime("-1 day"))?>" size=20 required >
										 </div>
									  </div>
									  <div class="col-md-2">
										<div class="form-group">
										  <label class="bmd-label-floating">Phone/Name</label>
											<input type="text" title="" id="phone" name="phone" value="" class="form-control" size=20 required >
										 </div>
									  </div>
									  <div class="col-md-2">
										<div class="form-group">
										  <input type="button" class="btn btn-primary pull-right" onclick="searchId()" value="Search"> 
										 </div>
									  </div>
									  <div class="col-md-4">
										<div class="form-group">
										  <input type="button" class="btn btn-primary pull-right" onclick="csv()" value="Download CSV"> 
										 </div>
									  </div>
									</div>
								</form>
							</h3>
							<form name=frm2 method=post action="deleteusers.php"> 
							<table class="table" cellpadding=0>
							<thead>
							<tr>
								<!-- <th>Sl No</th> -->
								<th><a href="#a" id="checkAll" onclick="checkallval()">Select All</a></th>
								<th>Report<br>ID</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Onset<br>Date</th>
								<th>Postal<br>Code</th>
								<th>Start<br>Time</th>
								<th>End<br>Time</th>
								<th>IP<br>Address</th>
								<th>Videos</th>
								<th>Individual<br>Report</th>
							</tr>
							
							</tr>
								</thead>
								<tbody>

								<?php


								$sQry = "SELECT `uid`, `u_name`, `u_phone`, `u_email`, `onset_date`, `u_postalcode`, 
								`start_time`, `end_time`, `ip_address`, `viewd_vidos` FROM `wp_access_user_master` a WHERE 1=1";
								if ($phone != '') {
									$sQry=$sQry." and ( a.`u_phone` like '%".$phone."%' or a.`u_name` like '%".$phone."%')  "; 
								} else {
									$sQry=$sQry." and DATE(a.`start_time`) >= '".$fromDate."' ";
									$sQry=$sQry." and DATE(a.`start_time`) <= '".$toDate."' ";
								}

								$sQry=$sQry." order by a.`start_time` desc";

								//echo $sQry;

 
								$result = mysqli_query($conn,$sQry);
								$i = 0;


								if($result)
								{
									while ( $rows = mysqli_fetch_array($result) )
									{
										$i++;
										$viewd_vidos = $rows["viewd_vidos"];

										$video_viewed = "";
										$str_vid_arr = explode(",", $viewd_vidos);
										foreach($str_vid_arr as $video) {
											if ($video=="1") {
												$video_viewed.="MOA Video ";
											}
											if ($video=="2") {
												$video_viewed.="Our Process Video ";
											}
											if ($video=="3") {
												$video_viewed.="Rosa Testimonial Video ";
											}
										}

										?>
										<tr>
										<!-- <td nowrap><?php echo $i; ?></td> -->
										<td nowrap><input type="checkbox" name="check<?php echo $i; ?>" id="check<?php echo $i; ?>">
											<input type="hidden" name="uid<?php echo $i; ?>"  id="uid<?php echo $i; ?>" class="cb-element" value="<?php echo $rows["uid"]; ?>">
										</td>
										<td nowrap><?php echo $rows["uid"]; ?></td>										
										<td nowrap><?php echo $rows["u_name"];?></td>
										<td nowrap><?php echo $rows["u_phone"]; ?></td>
										<td nowrap><?php echo $rows["u_email"]; ?></td>
										<td nowrap><?php echo $rows["onset_date"]; ?></td>
										<td nowrap><?php echo $rows["u_postalcode"]; ?></td>
										<td nowrap><?php echo $rows["start_time"]; ?></td>
										<td nowrap><?php echo $rows["end_time"]; ?></td>
										<td nowrap><?php echo $rows["ip_address"]; ?></td>
										<td nowrap><?php echo $video_viewed; ?></td>
										<td nowrap><a href="#a" onclick="showresult(<?php echo $rows["uid"]; ?>)" >Report</a></td>
										</tr>
									<?php
									}
								}

								?>
								</tbody>
								<thead>
									<tr>
									
										<th colspan=3>
										<input type="hidden" name="totalrows" id="totalrows" value="<?php echo $i; ?>">
										<input type="button" class="btn btn-warning" value="Delete Users" onclick="if(confirm('Are you sure to delete? ')) deleteusers();"></th>

										<th>&nbsp;</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
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
						</form>

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