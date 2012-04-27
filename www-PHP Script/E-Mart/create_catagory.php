<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
	$cat_name = $_POST['cat_name'];
 	$content = $_POST['content'];
 	$image = $_POST['image'];
	$subj_id = $_POST['subj_id'];
?>
<?php

	$query = "INSERT INTO catagories (
				cat_name, sub_id, cat_image, content
			) VALUES (
				'{$cat_name}', {$subj_id}, '{$image}', '{$content}'
			)";
	$result = mysql_query($query, $connection);
	if ($result) {

		header("Location: staff.php");
		exit;
	} else {

		echo "<p>Subject creation failed.</p>";
		echo "<p>" . mysql_error() . "</p>";
	}
?>

<?php mysql_close($connection); ?>
