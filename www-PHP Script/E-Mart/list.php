<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php


  if ((isset($_GET['subj']))&&(isset($_GET['cat']))&&(isset($_GET['prod']))){
     $sel_subj=$_GET['subj'];
     $sel_cat=$_GET['cat'];
     $sel_prod=$_GET['prod'];
  }else{
     $sel_subj="";
     $sel_cat="";
     $sel_prod="";
  }
     $sel_subj_exists=1;
     $sel_cat_exists=1;
     $sel_prod_exists=1;
     if ($sel_subj!=""){
        $sel_query1="SELECT * FROM subjects WHERE id=".$sel_subj;
        $sel_subject_set=mysql_query($sel_query1,$connection);
        $sel_subject=mysql_fetch_array($sel_subject_set);

        if ($sel_cat!=""){
           $sel_query2="SELECT * FROM catagories WHERE id=".$sel_cat;
           $sel_catagories_set=mysql_query($sel_query2,$connection);
           $sel_catagories=mysql_fetch_array($sel_catagories_set);
           if ($sel_prod!=""){
              $sel_query3="SELECT * FROM products WHERE id=".$sel_prod;
              $sel_products_set=mysql_query($sel_query3,$connection);
              $sel_products=mysql_fetch_array($sel_products_set);


           }else{
               $sel_prod_exists=0;
           }
        }else{
            $sel_cat_exists=0;
            $sel_prod_exists=0;
        }
     }else{
          $sel_subj_exists=0;
          $sel_prod_exists=0;
          $sel_cat_exists=0;
     }


?>
<?php include("includes/header.php");
  //echo $session_id;
 if (isset($_POST["id"])){
      $id=$_POST["id"];
 }else{
      $id="";
 }
 if (isset($_POST["quantity"])){
     $quantity=$_POST["quantity"];
 }else{
     $quantity=1;
 }
 ?>
<table id="structure">
	<tr>
        <?php include("includes/navigation.php"); ?>
		<td id="page">
             <?php
                 if ($id==""){
                 
                 }else{
                   $query9="SELECT * FROM items WHERE id=".$id;
                   $sel_items_set=mysql_query($query9,$connection);
                   if (!$sel_items_set) {
		            	        die("Database query failed: " . mysql_error());
                    }
                   $sel_items=mysql_fetch_array($sel_items_set);
                   $prod_name=$sel_items['prod_name'];
                   $price=$sel_items['price'];
                   $discount=$sel_items['discount'];
                   $prod_wt=$sel_items['prod_wt'];

                   $query7 = "INSERT INTO list (
			              	prod_name, prod_id, prod_price, prod_wt, discount, quantity, user_id
			                ) VALUES (
				            '{$prod_name}', {$id}, {$price}, {$prod_wt}, {$discount}, {$quantity}, '{$session_id}'
		                    	)";
                   $result = mysql_query($query7, $connection);
                   }
                   echo "<br /><h2>"."List Of Products In The Cart"."<br />"."</h2>";

                   $net_wt=0;
                   $sum=0;
                   $serial_no=0;
                   $net_price=0;
                   $query8="SELECT * FROM list WHERE user_id='{$session_id}'";
                   $sel_list_set=mysql_query($query8,$connection);
                   echo "<table width=\"1100\" border=\"4\">";
                          echo "<tr>";
                                    echo "<th>";
                                         echo "S.no.";

                                    echo "</th>";

                                    echo "<th>";
                                         echo "Product ID";
                                    echo "</th>";
                                    
                                    echo "<th>";
                                           echo "Product Name";
                                    echo "</th>";

                                    echo "<th>";
                                         echo "PRICE";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "Product Weight";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "Discount";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "Quantity";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "Net price";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "Remove from Cart";
                                    echo "</th>";
                                echo "</tr>";



                    while ($sel_list=mysql_fetch_array($sel_list_set)){


                               echo "<tr>";
                                    echo "<th>";
                                         $serial_no=$serial_no+1;
                                         echo $serial_no."<br />";
                                    echo "</th>";

                                    echo "<th>";
                                         echo $sel_list['prod_id']."<br />";
                                    echo "</th>";
                                    
                                    echo "<th>";
                                           echo $sel_list['prod_name']."<br />";
                                    echo "</th>";
                                    echo "<th>";
                                         //$sum=$sel_list['prod_price']+$sum;
                                         echo "Rs.".$sel_list['prod_price']."<br />";
                                    echo "</th>";

                                    echo "<th>";
                                         $net_wt=$net_wt+$sel_list["prod_wt"];
                                         echo $sel_list["prod_wt"]."gm<br />";
                                    echo "</th>";
                                    echo "<th>";
                                         echo $sel_list["discount"]."%<br />";
                                    echo "</th>";
                                    echo "<th>";
                                         echo $sel_list["quantity"]."<br />";
                                    echo "</th>";
                                    echo "<th>";
                                         $net_price=$sel_list['prod_price'];
                                         $dis=($sel_list["discount"]/100)*$net_price;
                                         $net_price=$net_price-$dis;
                                         $net_price=$net_price*$sel_list["quantity"];
                                         $sum=$net_price+$sum;
                                         echo "Rs.".$net_price."<br />";
                                    echo "</th>";
                                    echo "<th>";
                                            echo "<form action=\"remove_prod.php\" method=\"POST\" >";
                                           echo "<input type=\"hidden\" name=\"id\" value=\"".$sel_list['id']."\"  /> <br />";
                                           echo "<input type=\"submit\" value=\"Remove from Cart\"/>";

                                           echo "</form>";


                                    echo "</th>";
                                    
                                echo "</tr>";
                                               //echo "<tr>";

                               //echo "</tr>";

                    }


                    echo "</table><b><br /><br />";
                    echo "Total cost= Rs.".$sum."<br />";
                    echo "Total Wt= ".$net_wt."gm<br />";
                    $vat=$net_price*(.12);
                    $sum=$vat+$sum;
                    echo "Vat(12%)= Rs.".$vat."<br />"  ;
                    $sum=($net_wt*0.1)+$sum;
                    echo "net ammount =Rs. ".$sum."<br /><br /></b> ";
                    
                    echo "<table width=\"1000\" border=\"0\">";
                          echo "<tr>";
                                    echo "<th>";
                                         echo "<img src=\"images/general/cross.jpg\" \"width=\"70\" height=\"50\"  align=\"center\"/>";
                                         echo "<form action=\"remove_all_list.php\" method=\"POST\" ><br />";
                                         echo "<INPUT TYPE=\"image\" SRC=\"images/general/remove_all.jpg\" HEIGHT=\"30\" WIDTH=\"73\" BORDER=\"0\" ALT=\"remove all\">";

                                         echo "</form>";

                                    echo "</th>";
                                    echo "<th>";
                                             echo "<img src=\"images/general/continue.jpeg\" \"width=\"100\" height=\"50\"  align=\"center\"/>";
                                             echo "<form action=\"content.php\" ><br />";
                                             echo "<INPUT TYPE=\"image\" SRC=\"images/general/continue.jpg\" HEIGHT=\"30\" WIDTH=\"120\" BORDER=\"0\" ALT=\"continue shopping\">";

                                              echo "</form>";
                                    echo "</th>";
                                    echo "<th>";

                                         echo "<form action=\"buy_now.php\" method=\"POST\" >";
                                              echo "<img src=\"images/general/credit.jpg\" \"width=\"70\" height=\"50\"  align=\"center\"/>";
                                              echo "<input type=\"hidden\" name=\"net_amount\" value=\"".$sum."\"  /> <br /><br />";
                                              echo "<INPUT TYPE=\"image\" SRC=\"images/general/Buy_Now.jpg\" HEIGHT=\"30\" WIDTH=\"70\" BORDER=\"0\" ALT=\"Buy Now\">";



                                         echo "</form>";
                                    echo "</th>";

                          echo "</tr>";
                   echo "</table>";

            ?>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>
