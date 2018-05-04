<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 

    include'../classes/Brand.php';

   if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
     echo "<script>window.location = 'brandlist.php';</script>";
   }else{
     $id = $_GET['brandid'];
   } 

   $brand = new Brand();
   
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $brandName = $_POST['brandName'];
      

      $updateBrand = $brand->updateBrand($brandName, $id);
   }


?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Brand</h2>
               <div class="block copyblock"> 
                <?php

                    if(isset($updateBrand)){
                        echo $updateBrand;
                    }

                ?> 

                <?php 
                    $getBrand = $brand->brandEdit($id);

                    if($getBrand){
                        while( $result = $getBrand->fetch_assoc() ){
                ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name ="brandName" class="medium" value="<?php echo $result['brandName'];?>" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>

                    <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>