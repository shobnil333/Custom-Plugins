<?php
if(!isset($_SESSION["adminuserid"])) {
?>
<script type="text/javascript">
	alert('Your session expired');
	parent.location.href = '../../index.php';
</script>
<?php
exit;
}
?>
