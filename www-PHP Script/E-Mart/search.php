
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php include("includes/header.php");


 ?>
<table id="structure">
	<tr>
        <?php include("includes/navigation.php"); ?>
		<td id="page">
            <h1>YOUR SEARCH RESULTS</h1>
            <?php

                   $result=mysql_query("SELECT * FROM items WHERE prod_name LIKE \"%".$_POST["search"]."%\" ",$connection);
                   echo "<table width=\"1100\" border=\"4\">";
                          echo "<tr>";
                                   echo "<th>";
                                         echo "<h4>Thumbnail</h4>";

                                    echo "</th>";
                                    echo "<th>";
                                           echo "<h4>Product Name</h4>";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "<h4>Product Description</h4>";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "<h4>PRICE</h4>";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "<h4>Product Weight</h4>";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "<h4>Discount</h4>";
                                    echo "</th>";
                                     echo "<th>";
                                         echo "<h4>Buy now</h4>";
                                    echo "</th>";


                           $serial_no=0;
                   while($sel_items=mysql_fetch_array($result)){





                               echo "<tr>";
                                    echo "<th>";
                                         echo "<img src=\"".$sel_items["prod_image"]." \"width=\"100\" height=\"100\"  align=\"left\"/>";

                                    echo "</th>";
                                    echo "<th>";
                                           echo $sel_items[1]."<br />";
                                    echo "</th>";
                                    echo "<th>";
                                         echo $sel_items["content"]."<br />";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "Rs.".$sel_items["price"]."<br />";
                                    echo "</th>";
                                    echo "<th>";
                                         echo $sel_items["prod_wt"]."gm<br />";
                                    echo "</th>";
                                    echo "<th>";
                                         echo $sel_items["discount"]."%<br />";
                                    echo "</th>";
                                    echo "<th>";

                                          echo "<form action=\"list.php\" method=\"post\" >";
                                                echo "<input type=\"hidden\" name=\"id\" value=\"".$sel_items["id"]."\"  /> <br />";
                                                echo "Quantity:" ;
				    	                        echo "<input type=\"text\" name=\"quantity\" value=\"1\"  style=\"width: 50px; height: 25px;\"  \" id=\"quantity\" /> <br />";
                                                //$_SESSION['id_selected']=$sel_items["id"];
                                               // echo $sel_items["id"];
                                                //echo $y;
                                                //$y=0;
                                                //$prod_selected=;
                                                echo "<INPUT TYPE=\"image\" SRC=\"images/general/add2cart.png\" HEIGHT=\"25\" WIDTH=\"90\" BORDER=\"0\" ALT=\"Add to the Cart\">";



                                           echo "</form>";
                                    echo "</th>";
                                echo "</tr>";
                    }


                    echo "</table><b><br /><br />";

                 ?>
       		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>
