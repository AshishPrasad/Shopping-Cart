
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
<?php include("includes/header.php"); ?>

  <table id="structure">
	<tr>
	<?php include("includes/navigation.php"); ?>

		<td id="page">

				<?php
                if (($sel_cat_exists==0)&&($sel_prod_exists==0)&&($sel_subj_exists==0)){
                    $sel_subj=1;
                    $sel_query1="SELECT * FROM subjects WHERE id=".$sel_subj;
                    $sel_subject_set=mysql_query($sel_query1,$connection);
                    $sel_subject=mysql_fetch_array($sel_subject_set);
                    echo "<br />"."<h2>".$sel_subject['menu_name']."<br />"."</h2>"."<br />"."<br />";
                    echo $sel_subject['content']."<br />"."<br />";
                    echo "<center><br />";
                    echo "<a href=\"content.php\"><img src=\"".$sel_subject['sub_picture']." \"width=\"400\" height=\"400\"  align=\"center\"/>";
                 }
                elseif (($sel_cat_exists==0)&&($sel_prod_exists==0)){
                    echo "<br />"."<h1>".$sel_subject['menu_name']."<br />"."</h1>"."<br />"."<br />";
                    echo $sel_subject['content']."<br />"."<br />";
                    echo "<center><br />";
                    echo "<a href=\"content.php?subj=".urlencode($sel_subject["id"])."&cat=&prod="."\">"."<img src=\"".$sel_subject['sub_picture']." \"width=\"400\" height=\"400\"  align=\"center\"/>";
               }
                elseif ($sel_prod_exists==0){
                    echo "<h1>".$sel_catagories['cat_name']."<br />"."</h1>";
//                     echo "<img src=\"".$sel_catagories['cat_image']." \"width=\"155\" height=\"900\"  align=\"right\"/>";
                    echo $sel_catagories['content']."<br />"."<br />";

                    $products_set = mysql_query("SELECT * FROM products WHERE cat_id={$sel_cat}", $connection);
		                       if (!$products_set) {
		                               die("Database query failed: " . mysql_error());
                               }
                    while ($products = mysql_fetch_array($products_set)) {
                                     echo "<a href=\"content.php?subj=".urlencode($sel_subject["id"])."&cat=".urlencode($sel_catagories["id"])."&prod=".urlencode($products["id"])."\">"."<img src=\"".$products["prod_image"]." \"width=\"105\" height=\"100\"  align=\"left\"/>"."</a>"."<br />".$products["content"]."<p>"."<br />"."<br />"."<br />"."<br />"."<br />"."<br />" ;

                    }
                 }

                elseif ($sel_prod_exists==1){
                     //echo "cfga";
                    echo "<br /><h2>".$sel_products['prod_name']."<br />"."</h2>";

                    echo $sel_products['content']."<br />"."<br />";

                    $sel_query4="SELECT * FROM items WHERE prod_id=".$sel_prod;
                    $sel_items_set=mysql_query($sel_query4,$connection);
                     echo "<table width=\"1000\" border=\"4\">";
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
                                echo "</tr>";
                    while ($sel_items=mysql_fetch_array($sel_items_set)){

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
                                               //echo "<tr>";

                               //echo "</tr>";

                    }

                    echo "</table>";
                 }


                //if ($sel_prod_exists==1){
                  // echo $sel_products[1];
                  //}
                //echo $sel_cat;


            ?>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>
