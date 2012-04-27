<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
	$menu_name = $_POST['subcat_name'];
	$image = $_POST['image'];
	$content = $_POST['content'];
	$cat_id = $_POST['cat_id'];
?>
<?php
	$query = "INSERT INTO products (
				prod_name, cat_id, prod_image, content
			) VALUES (
				'{$menu_name}', {$cat_id}, '{$image}', '{$content}'
			)";
	$result = mysql_query($query, $connection);
	if ($result) {
		// Success!
		header("Location: staff.php");
		exit;
	} else {
		// Display error message.
		echo "<p>Subject creation failed.</p>";
		echo "<p>" . mysql_error() . "</p>";
	}
?>

<?php mysql_close($connection); ?>
