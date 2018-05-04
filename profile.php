<?php include'partials/header.php';?>
 <style>
  .tblone{width:550px; margin:0 auto;border:2px solid #ddd;}
  .tblone tr td{text-align:justify;}
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
			
			<table class="tblone">
				<tr>
					<td width="20%">Name</td>
					<td width="5%">:</td>
					<td><?php echo $result['name'];?></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>:</td>
					<td><?php echo $result['phone'];?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $result['email'];?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td>:</td>
					<td><?php echo $result['address'];?></td>
				</tr>
				<tr>
					<td>City</td>
					<td>:</td>
					<td><?php echo $result['city'];?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>:</td>
					<td><?php echo $result['country'];?></td>
				</tr>
				<tr>
					<td>Zip</td>
					<td>:</td>
					<td><?php echo $result['zip'];?></td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td><a href="editcustomer.php">Customer Details</a></td>
				</tr>
				
				
			</table>

			<?php }} ?>
					
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include'partials/footer.php';?>

