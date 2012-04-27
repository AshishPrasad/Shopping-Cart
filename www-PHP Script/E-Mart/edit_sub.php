<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php

    $menu_name = $_POST['sub_name'];
    $sub_id = $_POST['id'];
	$content = $_POST['sub_content'];
	$sub_image = $_POST['sub_image'];
?>
<?php

    $query = "UPDATE subjects SET
			   menu_name = '{$menu_name}',
               content = '{$content}',
               sub_picture = '{$sub_image}'
               WHERE id = {$sub_id}";

	$result = mysql_query($query, $connection);
	if ($result) {

		header("Location: staff.php?subj={$sub_id}&cat=&prod=");
		exit;
	} else {

		echo "<p>Subject editing failed.</p>";
		echo "<p>" . mysql_error() . "</p>";
	}
?>

<?php mysql_close($connection); ?>
