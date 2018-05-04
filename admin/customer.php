<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 

   $filepath = realpath(dirname(__FILE__));
   include_once($filepath.'/../classes/Customer.php');
?>

<?php 

  if(!isset($_GET['customerId']) || $_GET['customerId'] == NULL){
     echo "<script>window.location = 'inbox.php';</script>";
   }else{
     $id = $_GET['customerId'];
   } 

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock"> 
                 

                <?php 

                    $customer = new Customer();
                    $getCustomer = $customer->customerData($id);

                    if($getCustomer){
                        while( $result = $getCustomer->fetch_assoc() ){
                ?>

                 <form action="" method="">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>
                              <input type="text" class="medium" value="<?php echo $result['name'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                              <input type="text" class="medium" value="<?php echo $result['address'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                              <input type="text" class="medium" value="<?php echo $result['city'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>
                              <input type="text" class="medium" value="<?php echo $result['country'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zip</td>
                            <td>
                              <input type="text" class="medium" value="<?php echo $result['zip'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>
                              <input type="text" class="medium" value="<?php echo $result['phone'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                              <input type="text" class="medium" value="<?php echo $result['email'];?>" />
                            </td>
                        </tr>
					              <tr> 
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>

                    <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>