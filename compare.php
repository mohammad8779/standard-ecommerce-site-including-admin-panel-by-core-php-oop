<?php include'partials/header.php';?>
<?php 
  $login = Session::get("cmrLogin");
  if($login == false){
      header("Location:login.php");
  }
?>
 <style>
    table.tblone img{
      height:40px;
      width:80px;
    }
</style>
<div class="main">
    <div class="content">
    	<div class="section group">	
    	     <h2>Your Compare Products.</h2> 



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

                    $getallComparepro = $pd->getComparedata($cmrId);
                    
                    $i = 0; 
                    if($getallComparepro){
                     while($result = $getallComparepro->fetch_assoc()){
                                    
                      $i++

                    
                 ?>
              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $result['productName'];?></td>
                <td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
                <td>$<?php echo $result['price'];?></td>
                 <td><a href="details.php?proid=<?php echo $result['ProductId'];?>">View</a></td>
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

