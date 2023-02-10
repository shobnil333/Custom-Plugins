<?php
session_start();

// Finally, destroy the session.
session_destroy();

//header('location:./index.php');
//exit;
?>

<script type="text/javascript">
    parent.location.href = '../../';
</script>