<?php
session_start();
include '../../../connection.php';
include '../../../db.php';
include 'header.php';
$qid=$_GET['qid'];


$sqlAns = "SELECT a.`aid`, a.`answer_text`,adm.advice_content from answer_master a join `question_answer_map_tbl` qat on qat.qid=$qid and qat.aid=a.aid left join advice_master adm on adm.aid = a.aid and adm.qid=$qid  order by a_order";
//echo $sqlAns;
$resultsAns = $conn->query($sqlAns);
?>

<style>

table.borderless td,table.borderless th{
     border: none !important;
}


</style>
        <div class="container-fluid">
          <div class="row">
			<div class="col-md-12">
              <div class="card">
                <div class="card-header">
  					<form method="post" action="saveadvice.php">
					<table class="table table-hover borderless" cellpadding=0>
						<thead class="thead-dark"> 
						<tr>
							<!-- <th>Sl No</th> -->
							<th>Answer</th>
							<th>Advice Text</th>
						</tr>
						</tr>
						</thead>
						<tbody>

						<?php
						$i=0;
						while($row = $resultsAns->fetch_assoc()) {
						$i++;
						?>
						<tr>
							<td><?php echo $row["answer_text"] ?> 
								<input type="hidden" name="aid<?php echo $i; ?>" value="<?php echo $row["aid"]; ?>">
							</td>
							<td><input type="text" class="form-control"  name="advice<?php echo $i; ?>" value="<?php echo $row["advice_content"]; ?>" required> </td>
						</tr>
						<?php
						}
						?>
						<tr>
							<td colspan=2>
							<div class="form-group">
								<input type="hidden" name="totalRows" value="<?php echo $i; ?>">
								<input type="hidden" name="qid" value="<?php echo $qid; ?>">
							  <input type="submit" class="btn btn-primary pull-right" onclick="" value="Save"> 
							 </div>
							 </td>

						</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>
</body>

</html>
