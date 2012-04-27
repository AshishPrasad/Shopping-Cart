<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
	$menu_name = $_POST['menu_name'];
 	$content = $_POST['content'];
 	$image = $_POST['image'];
?>
<?php
	$query = "INSERT INTO subjects (
				menu_name, sub_picture, content
			) VALUES (
				'{$menu_name}', '{$image}' , '{$content}'
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
