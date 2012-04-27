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
		</td>
		<td id="page">

            <h2>Add New User</h2>
			   <form action="create_newuser.php" method="post">

                    <p>Catagory name:
					<input type="text" name="user_name" value="" id="user_name" />
                    </p>

                    <p>Set Password:
					<input type="password" name="pass1" value="" id="pass1" />
                    </p>
                    
                    <p>Confirm Password:
					<input type="password" name="pass2" value="" id="pass2" />
                    </p>

                    <input type="submit" value="Add user" />
			  </form>
			  <br />
			  <a href="staff.php">Cancel</a>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>
