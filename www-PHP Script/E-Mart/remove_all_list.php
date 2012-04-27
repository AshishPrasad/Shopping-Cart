<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
    $id=$_POST['id'];
    $query = "DELETE FROM list";
    $result = mysql_query($query, $connection);

           header("Location: list.php ");



?>
<?php mysql_close($connection); ?>
