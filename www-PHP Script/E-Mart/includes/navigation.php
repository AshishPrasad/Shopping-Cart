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
			             echo "<a href=\"content.php?subj=".urlencode($subject["id"])."&cat=".urlencode($catagories["id"])."&prod=".urlencode($products["id"])."\">"."<li>".$subject["menu_name"]."</li>"."</a>" ;
                         $catagories_set = mysql_query("SELECT * FROM catagories WHERE sub_id={$subject["id"]}",$connection);
                         if (!$catagories_set) {
		            	           die("Database query failed: " . mysql_error());
                         }
                         echo "<ul class=\"catagories\">";
                         while ($catagories = mysql_fetch_array($catagories_set)) {
			                   echo "<br />"."<a href=\"content.php?subj=".urlencode($subject["id"])."&cat=".urlencode($catagories["id"])."&prod=".urlencode($products["id"])."\">"."<li>".$catagories["cat_name"]."</li>"."</a>";
                               $products_set = mysql_query("SELECT * FROM products WHERE cat_id={$catagories["id"]}", $connection);
		                       if (!$products_set) {
		                               die("Database query failed: " . mysql_error());
                               }
                               echo "<ul class=\"products\">";
                               while ($products = mysql_fetch_array($products_set)) {
                                     echo "<a href=\"content.php?subj=".urlencode($subject["id"])."&cat=".urlencode($catagories["id"])."&prod=".urlencode($products["id"])."\">"."<li>".$products["prod_name"]."</li>"."</a>" ;

                               }
                               echo "</ul>";
                         }
                         echo "<br />"."</ul>";

                    }
            ?>
            </ul>
            <a href="list.php"><img src="images/general/view_cart.jpg" width="80" height="35"  align="center"/></a><BR /><BR /><BR />
            <form action="search.php" method="post" >
                  <input type="text" name="search" value="" id="" /> <br />
                  <br />
                  <INPUT TYPE="image" SRC="images/general/search.jpg" HEIGHT="30" WIDTH="73" BORDER="0" ALT="Search">
            </form>
		</td>
