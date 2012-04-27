<?php session_start();
$session_id=session_id();
?>
<?php
     function add_product($prod_name,$prod_price,$prod_wt,$discount){
        global $connection;
        $query = "INSERT INTO list (
                 prod_name, prod_price, prod_wt, discount
			) VALUES (
				'{$prod_name}', {$prod_price}, {$prod_wt} , {$discount}
			)";
      $result = mysql_query($query, $connection);
     }

     function get_id(){

            //global $y;
             echo "inside" ;
            //$y=1;
            //return $y;
            //
     }
	
?>

<?php
function isValidEmail($email){
   $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

    if (preg_match($pattern, $email))
      $matched=1;
    else
      $matched=0;

    return $matched;

}
?>
<?php

function isValidCredit_card($creditcard){
    $pattern = "/^[0-9]{16}$/";

    if (preg_match($pattern, $creditcard))
      $matched=1;
    else
      $matched=0;

    return $matched;

}
?>

<?php
function isValidTel_num($tel){
    $pattern = "/^[0-9]{10}$/";

    if (preg_match($pattern, $tel))
      $matched=1;
    else
      $matched=0;

    return $matched;
}
?>

