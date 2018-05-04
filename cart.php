<?php include'partials/header.php';?>
<?php 

	if(isset($_GET['delpro'])){
    	$delid = $_GET['delpro'];

    	$delProduct = $ct->productdeleteByid($delid);
    }

?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
   	
      $cartId = $_POST['cartId'];
      $quantity = $_POST['quantity'];
      $updatecart = $ct->updateCartquantuty($quantity, $cartId);

      if($quantity <= 0){
      	$delProduct = $ct->productdeleteByid($cartId);
      }
   }
?>

<?php 
  if(!isset($_GET['id'])){

  		echo"<meta http-equive='refresh' content='0;URL=?id=anythings'/>";
  }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php 

			    		if(isset($updatecart)){
			    			echo $updatecart;
			    		}

			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="15%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php 
							    $getCart = $ct->cartProduct();
							    $sum = 0;
							    $qty = 0;
							    $i = 0;
								if($getCart){
									while($result = $getCart->fetch_assoc()){
                                    
									$i++
								
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $result['productName'];?></td>
								<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
								<td>$<?php echo $result['price'];?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'];?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity'];?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>$<?php 
									$total = $result['price'] * $result['quantity'];
								    echo $total;?></td>
								<td><a onclick="return confirm('are you sure to delete!')"href="?delpro=<?php echo $result['cartId'];?>">X</a></td>
							</tr>

							<?php 
								$qty = $qty + $result['quantity'];
								$sum = $sum + $total;

								Session::set("sum","$sum");
								Session::set("qty","$qty");
							?>
							
							<?php }}?>
						</table>
						<?php 
							
							$getData = $ct->checkCart();
							if($getData){
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>TK. 10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$<?php 
                                 
                                  $vat = $sum * 0.1;
                                  $grandtotal = $sum + $vat;

                                  echo $grandtotal;

								?></td>
							</tr>
					   </table>
					   <?php } else{
					   		//echo "<span style='color:red; font-size:18px'>Cart Empty!</span>";
					   	    header("Location:index.php");
					    }?>
		    </div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include'partials/footer.php';?>

