<?php include'partials/header.php';?>

<?php 
  $login = Session::get("cmrLogin");
  if($login == false){
  		header("Location:login.php");
  }
?>

<?php 

 $cmrId = Session::get("cmrId");

 if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ){
      
      $cmrUpdate = $cmr->customerUpdate($_POST,$cmrId);
   }

?>
 <style>
  .tblone{width:550px; margin:0 auto;border:2px solid #ddd;}
  .tblone tr td{text-align:justify;}
  .tblone input[type ='text']{width:400px; padding:10px;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">	
    	   <?php 
    	    $id = Session::get('cmrId');
    	   	 $getCustomer = $cmr->customerData($id);
    	   	 if($getCustomer){
    	   	 	while($result = $getCustomer->fetch_assoc()){
    	   ?>	
			<form action="" method="post">
			<table class="tblone">
				<?php 
					if(isset($cmrUpdate)){
						echo "<tr><td col-span='2'><h2>Update Profile Details</h2></td></tr>";
					}
				?>
				<tr>
					<td>Name</td>
					
					
					<td><input type="text" name="name" value="<?php echo $result['name'];?>"></td>
				</tr>
				<tr>
					<td>Phone</td>
					
					<td><input type="text" name="phone" value="<?php echo $result['phone'];?>"></td>
				</tr>
				<tr>
					<td>Email</td>
					
					<td><input type="text" name="email" value="<?php echo $result['email'];?>"></td>
				</tr>
				<tr>
					<td>Address</td>
					
					<td><input type="text" name="address" value="<?php echo $result['address'];?>"></td>
				</tr>
				<tr>
					<td>City</td>
					
					<td><input type="text" name="city" value="<?php echo $result['city'];?>"></td>
				</tr>
				<tr>
					<td>Country</td>
					
					
					<td><input type="text" name="country" value="<?php echo $result['zip'];?>"></td>
				</tr>
				<tr>
					<td>Zip</td>
					
					<td><input type="text" name="zip" value="<?php echo $result['country'];?>"></td>
					
				</tr>

				<tr>
					<td></td>
					
					<td><input type="submit" name="submit" value="Update Profile"></td>
				</tr>
				
				
			</table>
		  </form>

			<?php }} ?>
					
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include'partials/footer.php';?>

