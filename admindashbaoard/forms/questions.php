<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'header.php';
include 'session.php';

$userid=$_SESSION['adminuserid'];
$newqid="";
if($_GET) {
	$newqid=$_GET["newqid"];
}
?>

<script>
	function editAdvice(qid) {

		var width = screen.width/2;
		var height = screen.height/2;

		var left = (screen.width - width) / 2; 
		var top = (screen.height - height) / 4; 
		  
		var myWindow = window.open('editadvice.php?qid='+qid, 'Edit Advice',  
				'resizable=yes, width=' + width 
				+ ', height=' + height + ', top=' 
                    + top + ', left=' + left); 
    }
	function editq(qid) {
		location.href='editq.php?qid='+qid;
	}

	
	function deleteq(qid) {
		location.href='deleteq.php?qid='+qid;
	}

	function addquestion(qid) {
		location.href='addquestion.php';
	}

	function saveorder() {

		var sorted_arr=[];

		for (var i=1;i<=document.getElementById('totalrows').value;i++) {

			if(sorted_arr.includes(document.getElementById('orderno'+i).value)) {
				alert('Duplicate order found in row ' + i );
				document.getElementById('orderno'+i).focus();
				return false;
			}
			if (document.getElementById('orderno'+i).value!=0)
			{
				sorted_arr.push(document.getElementById('orderno'+i).value);
			}
		}

		document.frm.submit();

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
                  <h4 class="card-title ">Question Master</h4>
                  <!-- <p class="card-category"> Level 1</p>
 -->                </div>
				<div class="card-body">
					<div class="tree">
						<div class="card-body">
						  <div class="table-responsive">
						  	<form method="post" name="frm" action="saveorder.php" >
							<table class="table" cellpadding=0>							
							<thead>
								<tr>
									<th colspan=4 style="text-align:center">
									<input type="button" class="btn btn-primary" value="Add New Question" onclick="addquestion();"></th>
								</tr>
							<tr>
								<th>Sl No</th>
								<th>Edit</th>
								<th>Question Text</th>
								<th>Delete</th>
							</tr>
							
							
							</tr>
								</thead>
								<tbody>
								<?php


								$sQry = "SELECT `qid`, `qorder`, `questions` FROM `wp_access_question_master` a WHERE 1=1 ";
								//$sQry=$sQry." order by followup desc, a.`qorder` desc";
								
								//$sQry = "SELECT `qid`, `qorder`, `questions`,followup,(select count(1) as adv_cnt from advice_master adm where adm.qid =a.qid ) as adv_cnt FROM `wp_access_question_master` a WHERE 1=1 ";
								//$sQry=$sQry." order by followup desc, a.`qorder` desc";

								//echo $sQry;

								$result = mysqli_query($conn,$sQry);
								$i = 0;
								

								if($result)
								{
									while ( $rows = mysqli_fetch_array($result) )
									{
										$i++;
								
										?>
										<tr>

											<td nowrap><?php echo $i; ?></td>
											<td nowrap><input type="button" class="btn btn-primary" value="Edit" onclick="editq(<?php echo $rows["qid"]; ?>)"></td>
											
											<td nowrap><?php echo $rows["questions"]; ?></td>
											<td nowrap><input type="button" class="btn btn-warning" value="Delete" onclick="if(confirm('Are you sure to delete? ')) deleteq(<?php echo $rows["qid"]; ?>);"></td>
											
										</tr>
									<?php
									}
								}

								?>
								</tbody>
							</table>
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
