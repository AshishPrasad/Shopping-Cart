
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php include("includes/header.php");


 ?>
<table id="structure">
	<tr>
        <?php include("includes/navigation.php"); ?>
		<td id="page">
            <h1>THANK YOU FOR BUYING</h1>
            <?php

                   echo "<br /><h2>"."List Of Products In The Cart"."<br />"."</h2>";

                   $net_wt=0;
                   $sum=0;
                   $serial_no=0;
                   $net_price=0;
                   $query8="SELECT * FROM list WHERE user_id='{$session_id}'";
                   $sel_list_set=mysql_query($query8,$connection);
                   echo "<table width=\"1200\" border=\"4\">";
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
                    $query1="SELECT * FROM orders WHERE user_id='{$session_id}'";
                    $sel_list_set=mysql_query($query1,$connection);

                    while ($sel_list=mysql_fetch_array($sel_list_set)){
                          $name=$sel_list['name'];
                          $address=$sel_list['address'];
                          $email=$sel_list['email'];
                          $mobile=$sel_list['mobile'];
                    }
                    
                    echo "Your name: ".$name."<br />";
                    echo "Your address: ".$address."<br />";
                    echo "Your email: ".$email."<br />";
                    echo "Your mobile: ".$mobile."<br />";
                 ?>
       		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>
