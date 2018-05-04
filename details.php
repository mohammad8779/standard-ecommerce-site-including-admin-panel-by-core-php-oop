<?php include'partials/header.php';?>

<?php 

   if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
     echo "<script>window.location = '404.php'; </script>";
   }else{
     $id = $_GET['proid'];
   } 
  
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
   	
      $quantity = $_POST['quantity'];
      $addCart = $ct->addTocart($quantity, $id);
   }
   
?>



<?php 

   //this is for compare products

   $cmrId = Session::get('cmrId');
   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){
   	
      $productId = $_POST['productId'];
      $insertComparepro = $pd->insertCompareproducts($productId,$cmrId);
   }

?>

<?php 

   //this is for wishlist products

   $cmrId = Session::get('cmrId');
   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])){
   	
      $productId = $_POST['productId'];
      $insertWishlistpro = $pd->insertWishlistproducts($productId,$cmrId);
   }

?>

 <div class="main">
    <div class="content">
    	<div class="section group">

    		<?php 

    			$singlePro = $pd->getSinglePro($id);

    			if($singlePro){
    				while($result = $singlePro->fetch_assoc()){

    			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image'];?>" alt="" />
					</div>

				<div class="desc span_3_of_2">


					<h2><?php echo $result['productName'];?></h2>
										
					<div class="price">
						<p>Price: <span>$<?php echo $result['price'];?></span></p>
						<p>Category: <span><?php echo $result['catName'];?></span></p>
						<p>Brand:<span><?php echo $result['brandName'];?></span></p>
					</div>

				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>		
				</div>	

					<span style="color:red; font-size:18px">
						<?php 
							if(isset($addCart)){
								echo $addCart;
							}
						?>
					</span>	

			    <?php 
					if(isset($insertComparepro)){
						echo $insertComparepro;
					}
				?>	

				<?php 
					if(isset($insertWishlistpro)){
						echo $insertWishlistpro;
					}
				?>		

				<?php 
					$login = Session::get("cmrLogin");

					if($login == true){

				?>

			    <div class="add-cart">
					<form action="" method="post">
						<input type="submit" class="buysubmit" name="compare" value="Add To Compare"/>
						<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId'];?>"/>
					</form>		
				</div>	

				  <div class="add-cart">
					<form action="" method="post">
						<input type="submit" class="buysubmit" name="wlist" value="Add To Wishlist"/>
						<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId'];?>"/>
					</form>		
				</div>	

				<?php } ?>	

				


			</div>

			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $result['body'];?>
	       </div>
				
	      </div>

	      <?php } } ?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
					 <?php 
                         
                         $catProduct = $cat->catShow();

                         if($catProduct){
                         	while($result = $catProduct->fetch_assoc()){
					 ?>

				      <li><a href="productbycat.php?catid=<?php echo $result['catId'];?>"><?php echo $result['catName'];?></a></li>
				      <?php } } ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>
   <?Php include'partials/footer.php';?>

