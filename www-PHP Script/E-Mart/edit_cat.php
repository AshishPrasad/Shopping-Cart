<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php

    $menu_name = $_POST['cat_name'];
    $sub_id = $_POST['sub_id'];
	$content = $_POST['cat_content'];
	$cat_image = $_POST['cat_image'];
	$id = $_POST['id'];
?>
<?php

    $query = "UPDATE catagories SET
			   cat_name = '{$menu_name}',
               content = '{$content}',
               sub_id = {$sub_id},
               cat_image = '{$cat_image}'
               WHERE id = {$id}";

	$result = mysql_query($query, $connection);
	if ($result) {

		header("Location: staff.php?subj={$sub_id}&cat={$id}&prod=");
		exit;
	} else {

		echo "<p>Subject editing failed.</p>";
		echo "<p>" . mysql_error() . "</p>";
	}
?>

<?php mysql_close($connection); ?>
