
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php include("includes/header.php");
$net_amount = $_POST['net_amount'];

 ?>
<table id="structure">
	<tr>
        <?php include("includes/navigation.php"); ?>
        
		<td id="page">
              <h1>Checkout<h1 />
               <center><br />

              <form action="checkout.php" method="POST">
                <table width="500" border="0">
                   <tr>
                       <td>Name</td>
                       <td> <input name="name" type="text" value="" /></td>
                       <td></td>
                   </tr>

                   <tr>
                       <td>Address</td>
                       <td> <textarea name="address" row=7 column=4></textarea></td>
                       <td></td>
                   </tr>

                   <tr>
                       <td>Email*</td>
                       <td> <input name="email" type="text" value="" /></td>
                       <td> Write in proper format. </td>
                   </tr>
                   
                   <tr>
                       <td>Mobile*</td>
                       <td> <input name="mobile" type="text" value="" size="10" /></td>
                       <td> Must be 10 digit number.</td>
                   </tr>

                   <tr>
                       <td>Bank</td>
                       <td> <input name="bank" type="text" value="" /></td>
                       <td></td>
                   </tr>

                   <tr>
                       <td>Card Number*</td>
                       <td> <input name="card_no" type="text" value="" size="16" /></td>
                       <td> Must be 16 digit number.</td>
                   </tr>
                </table>
             </p>
             
              <center> <h6> * fields can't be left empty. </h6> </center>
              
              <?php echo "<input type=\"hidden\" name=\"net_amount\" value=\"".$net_amount."\"  /> <br />"; ?>
              <img src="images/general/credit.jpg" width="70" height="50"  align="center"/> <br />  <br />
              <INPUT TYPE="image" SRC="images/general/submit.jpg" HEIGHT="30" WIDTH="73" BORDER="0" ALT="Submit Form">

             </form>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>
