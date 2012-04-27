<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
    $action = $_POST['action'];
    $prod_name = $_POST['prod_name'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $prod_wt = $_POST['prod_wt'];
	$content = $_POST['prod_content'];
	$prod_image = $_POST['prod_image'];
    $prod_id = $_POST['prod_id'];
    $cat_id = $_POST['cat_id'];
    $sub_id = $_POST['sub_id'];
    $id = $_POST['id'];
?>
<?php
    // echo $content;
    if ($action=="EDIT"){
          $query = "UPDATE items SET
			   prod_name = '{$prod_name}',
               content = '{$content}',
               prod_id = {$prod_id},
               price = {$price},
               discount = {$discount},
               prod_id = {$prod_id},
               prod_wt = {$prod_wt},
               prod_image = '{$prod_image}'
               WHERE id = {$id}";

	           $result = mysql_query($query, $connection);
	           if ($result) {

		          header("Location: staff.php?subj={$sub_id}&cat={$cat_id}&prod={$prod_id}");
		          exit;
	           } else {

		         echo "<p>Subject editing failed.</p>";
		         echo "<p>" . mysql_error() . "</p>";
	          }
	 }else{
	      $query = "DELETE FROM items WHERE id = {$id} LIMIT 1";
          $result = mysql_query($query, $connection);
          if (mysql_affected_rows() == 1) {
              header("Location: staff.php?subj={$sub_id}&cat={$cat_id}&prod={$prod_id}");
		      exit;
		  } else {
			// Deletion Failed
			echo "<p>deletion failed.</p>";
			echo "<p>" . mysql_error() . "</p>";

		 }
	 
	 
	 
	 }
?>

<?php mysql_close($connection); ?>
