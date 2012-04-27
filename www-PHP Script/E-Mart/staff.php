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
<?php include("includes/header_login.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
            <ul class="subjects">
            <?php

            		$subject_set = mysql_query("SELECT * FROM subjects", $connection);
		            if (!$subject_set) {
		            	        die("Database query failed: " . mysql_error());
                    }
                    $catagories["id"]="";
                    $products["id"]="";
                    while ($subject = mysql_fetch_array($subject_set)) {
			             echo "<a href=\"staff.php?subj=".urlencode($subject["id"])."&cat=".urlencode($catagories["id"])."&prod=".urlencode($products["id"])."\">"."<li>".$subject["menu_name"]."</li>"."</a>" ;
                         $catagories_set = mysql_query("SELECT * FROM catagories WHERE sub_id={$subject["id"]}",$connection);
                         if (!$catagories_set) {
		            	           die("Database query failed: " . mysql_error());
                         }
                         echo "<ul class=\"catagories\">";
                         while ($catagories = mysql_fetch_array($catagories_set)) {
			                   echo "<br />"."<a href=\"staff.php?subj=".urlencode($subject["id"])."&cat=".urlencode($catagories["id"])."&prod=".urlencode($products["id"])."\">"."<li>".$catagories["cat_name"]."</li>"."</a>";
                               $products_set = mysql_query("SELECT * FROM products WHERE cat_id={$catagories["id"]}", $connection);
		                       if (!$products_set) {
		                               die("Database query failed: " . mysql_error());
                               }
                               echo "<ul class=\"products\">";
                               while ($products = mysql_fetch_array($products_set)) {
                                     echo "<a href=\"staff.php?subj=".urlencode($subject["id"])."&cat=".urlencode($catagories["id"])."&prod=".urlencode($products["id"])."\">"."<li>".$products["prod_name"]."</li>"."</a>" ;

                               }
                               echo "</ul>";
                         }
                         echo "<br />"."</ul>";

                    }
                    echo "<a href=\"new_user.php\"><img src=\"images/general/new_user.jpg\" width=\"150\" height=\"35\"  align=\"center\"/></a><BR /><a href=\"new_subject.php\"><img src=\"images/general/new_subject.jpg\" width=\"150\" height=\"35\"  align=\"center\"/></a><BR /><a href=\"new_catagory.php\"><img src=\"images/general/new_category.jpg\" width=\"150\" height=\"35\"  align=\"center\"/></a><BR /><a href=\"new_subcat.php\"><img src=\"images/general/new_subcat.jpg\" width=\"150\" height=\"35\"  align=\"center\"/></a>";

            ?>
            </ul>

		</td>
		<td id="page">

				<?php
                if (($sel_cat_exists==0)&&($sel_prod_exists==0)&&($sel_subj_exists==0)){
                    echo "<br /><h2>Welcome to the Staff Area</h2>";
                    echo "<a href=\"new_user.php\"><img src=\"images/general/new_user.jpg\" width=\"150\" height=\"35\"  align=\"center\"/></a><BR /><a href=\"new_subject.php\"><img src=\"images/general/new_subject.jpg\" width=\"150\" height=\"35\"  align=\"center\"/></a><BR /><a href=\"new_catagory.php\"><img src=\"images/general/new_category.jpg\" width=\"150\" height=\"35\"  align=\"center\"/></a><BR /><a href=\"new_subcat.php\"><img src=\"images/general/new_subcat.jpg\" width=\"150\" height=\"35\"  align=\"center\"/></a>";
                
                }
                elseif (($sel_cat_exists==0)&&($sel_prod_exists==0)){
                    echo "<h2><br />Edit Menu: ".$sel_subject['menu_name']."<br />"."</h2>";
                    echo "<form action=\"edit_sub.php\" method=\"POST\" >";
                          echo "Menu Name: <input type=\"text\" name=\"sub_name\" value=\"".$sel_subject['menu_name']."\"  style=\"width: 250px; height: 25px;\"  \" id=\"name\" /> <br /><br />";
                          echo "Content: <input type=\"text\" name=\"sub_content\" value=\"".$sel_subject['content']."\"  style=\"width: 550px; height: 100px;\"  \" id=\"content\" /> <br /><br />";
                          echo "Subject Image: <input type=\"text\" name=\"sub_image\" value=\"".$sel_subject['sub_picture']."\"  style=\"width: 250px; height: 25px;\"  \" id=\"image\" /> (Write the path of the image with reference to the root directory)<br /><br />";
                          echo "<input type=\"hidden\" name=\"id\" value=\"".$sel_subject["id"]."\"  />";
                           echo "<INPUT TYPE=\"image\" SRC=\"images/general/edit.jpg\" HEIGHT=\"25\" WIDTH=\"60\" BORDER=\"0\" ALT=\"edit\">";



                    echo "</form>";
                    //echo "subj no.".$sel_subj."<br />";
                 }
                elseif ($sel_prod_exists==0){
                    echo "<br /><h2>Edit Category: ".$sel_catagories['cat_name']."<br />"."</h2>";
                    echo "<form action=\"edit_cat.php\" method=\"POST\" >";
                          echo "Menu Name: <input type=\"text\" name=\"cat_name\" value=\"".$sel_catagories['cat_name']."\"  style=\"width: 250px; height: 25px;\"  \" id=\"name\" /> <br /><br />";
                          echo "Content: <input type=\"text\" name=\"cat_content\" value=\"".$sel_catagories['content']."\"  style=\"width: 550px; height: 100px;\"  \" id=\"content\" /> <br /><br />";
                          echo "Subject ID: <input type=\"text\" name=\"sub_id\" value=\"".$sel_catagories['sub_id']."\"  style=\"width: 30px; height: 25px;\"  \" id=\"sub_id\" /> <br /><br />";
                          echo "Category Image: <input type=\"text\" name=\"cat_image\" value=\"".$sel_catagories['cat_image']."\"  style=\"width: 250px; height: 25px;\"  \" id=\"image\" /> (Write the path of the image with reference to the root directory)<br /><br />";
                           echo "<input type=\"hidden\" name=\"id\" value=\"".$sel_catagories["id"]."\"  />";
                          echo "<INPUT TYPE=\"image\" SRC=\"images/general/edit.jpg\" HEIGHT=\"25\" WIDTH=\"60\" BORDER=\"0\" ALT=\"edit\">";


                    echo "</form>";

                 }

                elseif ($sel_prod_exists==1){

                    echo "<br /><h2>Edit Products: ".$sel_products['prod_name']."<br />"."</h2>";
                    $sel_query4="SELECT * FROM items WHERE prod_id=".$sel_prod;
                    $sel_items_set=mysql_query($sel_query4,$connection);
                     echo "<table width=\"1000\" border=\"1\">";
                          echo "<tr>";
                                    echo "<th>";
                                         echo "Thumbnail<br />(Write the path of the image with reference to the root directory)";

                                    echo "</th>";
                                    echo "<th>";
                                           echo "Product Name";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "Product Description";
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
                                         echo "Category ID";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "EDIT";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "DELETE";
                                    echo "</th>";
                                echo "</tr>";
                    while ($sel_items=mysql_fetch_array($sel_items_set)){

                               echo "<tr>";
                                    echo "<form action=\"edit_items.php\" method=\"POST\" >";
                                    echo "<th>";
                                         //echo "<img src=\"".$sel_items["prod_image"]." \"width=\"100\" height=\"100\"  align=\"left\"/>";
                                         echo "<br /><input type=\"text\" name=\"prod_image\" value=\"".$sel_items["prod_image"]."\"  style=\"width: 250px; height: 25px;\"  \" id=\"image\" /> <br />";
                                    echo "</th>";
                                    echo "<th>";

                                         echo "<br /><input type=\"text\" name=\"prod_name\" value=\"".$sel_items[1]."\"  style=\"width: 180px; height: 25px;\"  \" id=\"name\" /> <br />";

                                    echo "</th>";
                                    echo "<th>";
                                         echo "<br /><input type=\"text\" name=\"prod_content\" value=\"".$sel_items["content"]."\"  style=\"width: 280px; height: 50px;\"  \" id=\"content\" /> <br />";
                                    echo "</th>";
                                    echo "<th>";
                                         echo "Rs."."<input type=\"text\" name=\"price\" value=\"".$sel_items["price"]."\"  style=\"width: 50px; height: 25px;\"  \" id=\"price\" /> <br />";

                                    echo "</th>";
                                    echo "<th>";
                                         echo "<input type=\"text\" name=\"prod_wt\" value=\"".$sel_items["prod_wt"]."\"  style=\"width: 30px; height: 25px;\"  \" id=\"wt\" />gm <br />";


                                    echo "</th>";
                                    echo "<th>";
                                         echo "<input type=\"text\" name=\"discount\" value=\"".$sel_items["discount"]."\"  style=\"width: 30px; height: 25px;\"  \" id=\"discount\" />% <br />";


                                    echo "</th>";
                                    echo "<th>";
                                         echo "<input type=\"text\" name=\"prod_id\" value=\"".$sel_items["prod_id"]."\"  style=\"width: 30px; height: 25px;\"/>";

                                    echo "</th>";
                                    echo "<th>";
                                         echo "<input type=\"hidden\" name=\"id\" value=\"".$sel_items["id"]."\"  /> ";
                                         //echo "<input type=\"hidden\" name=\"prod_id\" value=\"".$sel_items["prod_id"]."\"  />";
                                         echo "<input type=\"hidden\" name=\"cat_id\" value=\"".$sel_cat."\"  /> ";
                                         echo "<input type=\"hidden\" name=\"sub_id\" value=\"".$sel_subj."\"  />";
                                         echo "<INPUT TYPE=\"image\" SRC=\"images/general/edit.jpg\" HEIGHT=\"25\" WIDTH=\"60\" BORDER=\"0\" ALT=\"edit\">";

                                    echo "</th>";
                                    echo "<th>";
                                                //echo "<input type=\"hidden\" name=\"id\" value=\"".$sel_items["id"]."\"  /> <br />";
                                         echo "<INPUT TYPE=\"image\" SRC=\"images/general/delete.jpg\" HEIGHT=\"25\" WIDTH=\"60\" BORDER=\"0\" ALT=\"delete\">";
                                    echo "</th>";
                                    echo "</form>";
                                echo "</tr>";

                    }

                    echo "</table>";

                    echo "<h2>Add New Product:</h2>";
			        echo "<form action=\"create_Product.php\" method=\"post\">";
				    echo "<p>Product name:";

                    echo "<input type=\"text\" name=\"prod_name\" value=\"\" id=\"prod_name\" /></p>";

                    echo "<input type=\"hidden\" name=\"prod_id\" value=\"".$sel_prod."\"  /> ";
                    echo "<input type=\"hidden\" name=\"cat_id\" value=\"".$sel_cat."\"  /> ";
                    echo "<input type=\"hidden\" name=\"sub_id\" value=\"".$sel_subj."\"  />";

                    echo "<p>Product Description:";
				    echo "<input type=\"text\" name=\"content\" value=\"\" style=\"width: 650px; height: 100px;\">";

                    echo "</p><p>Product Image:";
				    echo "<input type=\"text\" name=\"image\" value=\"\" style=\"width: 150px; height: 25px;\" >";

                    echo "</p><p>Product Price: Rs.";
				    echo "<input type=\"text\" name=\"price\" value=\"\" style=\"width: 50px; height: 25px;\" >";

                    echo "</p><p>Discount:";
				    echo "<input type=\"text\" name=\"discount\" value=\"\" style=\"width: 40px; height: 25px;\" >%";

                    echo "</p><p>Product Wt.:";
				    echo "<input type=\"text\" name=\"prod_wt\" value=\"\" style=\"width: 40px; height: 25px;\" >gm";



                    echo "<br /><br /><br />";
                     echo "<INPUT TYPE=\"image\" SRC=\"images/general/new_product.jpg\" HEIGHT=\"35\" WIDTH=\"120\" BORDER=\"0\" ALT=\"Add Product\">";


			  echo "</form>";




                 }
            ?>
            
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>
