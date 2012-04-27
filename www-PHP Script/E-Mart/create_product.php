<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
	$menu_name = $_POST['prod_name'];
	$content = $_POST['content'];
    $price = $_POST['price'];
	$discount = $_POST['discount'];
	$prod_wt = $_POST['prod_wt'];
	$prod_id = $_POST['prod_id'];
	$cat_id = $_POST['cat_id'];
    $sub_id = $_POST['sub_id'];
	$image = $_POST['image'];
?>
<?php
   // echo $menu_name.$price.$discount.$prod_wt.$prod_id.$cat_id.$sub_id.$image.$content;
    $query = "INSERT INTO items (
				prod_name, price, prod_wt, discount, prod_id, content, prod_image
			) VALUES (
				'{$menu_name}', {$price}, {$prod_wt}, {$discount}, {$prod_id}, '{$content}', '{$image}'
			)";
	$result = mysql_query($query, $connection);
	if ($result) {
		// Success!
		header("Location: staff.php?subj={$sub_id}&cat={$cat_id}&prod={$prod_id}");
		exit;
	} else {
		// Display error message.
		echo "<p>Subject creation failed.</p>";
		echo "<p>" . mysql_error() . "</p>";
	}
?>

<?php mysql_close($connection); ?>
