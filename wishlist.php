<?php include'partials/header.php';?>
 <style>
    table.tblone img{
      height:40px;
      width:80px;
    }
</style>

<?php 
    if(isset($_GET['delwlist'])){
      $cmrId = Session::get('cmrId');
      $productId = $_GET['delwlist'];

      $delwlistPro = $pd->deleteWlistpro($productId,$cmrId);

    }
?>
<div class="main">
    <div class="content">
    	<div class="section group">	
    	     <h2>Your Wishlist Products.</h2> 



           <table class="tblone">
              <tr>
                <th>SL</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
             

               <?php 
                    $cmrId = Session::get('cmrId');

                    $getallWishlistpro = $pd->getWishlistdata($cmrId);
                    
                    $i = 0; 
                    if($getallWishlistpro){
                     while($result = $getallWishlistpro->fetch_assoc()){
                                    
                      $i++

                    
                 ?>
              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $result['productName'];?></td>
                <td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
                <td>$<?php echo $result['price'];?></td>
                 <td>
                    <a href="details.php?proid=<?php echo $result['productId'];?>">Buy Now</a> || 
                    <a href="?delwlist=<?php echo $result['productId'];?>">Remove</a>

                  </td>
               </tr>

              
              <?php } } ?>
            </table>

            <div class="shopping">

                <div class="shopleft" style="width:100%; text-align: center;">
                  <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                
          </div>

      </div>   
    </div>
 </div>

<?php include'partials/footer.php';?>

