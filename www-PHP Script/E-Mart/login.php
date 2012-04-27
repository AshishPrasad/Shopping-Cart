<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
	$user_name = $_POST['user_name'];
	$pass = $_POST['pass'];
 ?>
<?php

	$user_set = mysql_query("SELECT * FROM user", $connection);
	if (!$user_set) {
	    die("Database query failed: " . mysql_error());
    }
    $true_user=0;
    while ($user = mysql_fetch_array($user_set)) {
        if (($user_name==$user["user_name"])&&($pass==$user["password"])){
            $true_user=1;
        }
    }
    ;
	if ($true_user==1) {
    	header("Location: staff.php");
		exit;
	} else {
        header("Location: content.php");
		exit;
	}
?>

<?php mysql_close($connection); ?>
