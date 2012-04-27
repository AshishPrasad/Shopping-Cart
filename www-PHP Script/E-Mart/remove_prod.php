<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
    $id=$_POST['id'];
    $query = "DELETE FROM list WHERE id = {$id} LIMIT 1";
    $result = mysql_query($query, $connection);
    if (mysql_affected_rows() == 1) {
           header("Location: list.php ");
		} else {
			// Deletion Failed
			echo "<p>deletion failed.</p>";
			echo "<p>" . mysql_error() . "</p>";
			echo "<a href=\"list.php\">Return to Cart</a>";
		}


?>
<?php mysql_close($connection); ?>
