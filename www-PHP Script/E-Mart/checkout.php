<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php

	$name = $_POST['name'];
	$address = $_POST['address'];
	$email = $_POST['email'];
    $mobile = $_POST['mobile'];
	$bank = $_POST['bank'];
	$card_no = $_POST['card_no'];
	$net_amount = $_POST['net_amount'];
	$user_id=$session_id;
	
?>



<?php

    if(isValidEmail($email)==1 && isValidCredit_card($card_no)==1 && isValidTel_num($mobile)==1)
    {
         $query1="SELECT * FROM list WHERE user_id='{$session_id}'";
         $sel_list_set=mysql_query($query1,$connection);
         $prod_list="";
         $quantity_list="";
         while ($sel_list=mysql_fetch_array($sel_list_set)){
                $prod_list=$sel_list['prod_id'].", ".$prod_list;
                $quantity_list=$sel_list['quantity'].", ".$quantity_list;
         }



         $query2 = "INSERT INTO orders (
		         		name, address, email, mobile, bank, card_no, prod_list, quantity, amount, user_id
			       ) VALUES (
				   '{$name}', '{$address}', '{$email}', '{$mobile}', '{$bank}', {$card_no}, '{$prod_list}', '{$quantity_list}', '{$net_amount}', '{$user_id}'
			    )";

	    $result = mysql_query($query2, $connection);
	    if ($result) {
		   echo "Success!";
    	   header("Location: thank_you.php");
		   exit;
	    } else {
		  // Display error message.
		  echo "<p>error</p>";
		  echo "<p>" . mysql_error() . "</p>";
	   }
    }else{
        echo $net_amount;
        echo "Check the entries you have made." ;
        echo "<ul>";
        if(isValidEmail($email)==0)
           echo "<li>"."The email entry is not in format" ;
        if(isValidCredit_card($card_no)==0)
           echo "<li>"."The card entry is not in format" ;
        if(isValidTel_num($mobile)==0)
           echo "<li>"."The mobile entry is not in format" ;
        echo "</ul>";
        echo "<form action=\"buy_now.php\" method=\"POST\" ><br />";
             echo "<input type=\"hidden\" name=\"net_amount\" value=\"".$net_amount."\"  /> <br />";
             echo "<input type=\"submit\" value=\"Go Back\"/>";
        echo "</form>";
    }

?>

<?php mysql_close($connection); ?>
