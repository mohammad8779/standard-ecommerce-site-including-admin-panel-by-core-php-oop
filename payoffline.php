<?php include'partials/header.php';?>
<?php 
  $login = Session::get("cmrLogin");
  if($login == false){
      header("Location:login.php");
  }
?>

<?php 
  if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
     $cmrId = Session::get('cmrId');
     $insertOrder = $ct->insertOrderfromcarttbl($cmrId);
     $delcart = $ct->delCustomercart();
     header("Location: success.php");
  }
?>
 <style>
   .tblone{width:550px; margin:0 auto;border:2px solid #ddd;}
   .tblone tr td{text-align:justify;}
   .division{width:50%; float:left;}
   .tabletwo{float: right;text-align: left;width: 45%;border: 1px solid #ddd;margin: 11px;padding: 10px;display: block;}
   .ordernow{text-align:center; margin-bottom: 30px; }
   .ordernow a{background: #000000; padding: 10px; font-size: 25px; color:#fff;  }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">	
    	    
          <div class="division">
              
              <table class="tblone">
              <tr>
                <th>SL</th>
                <th>Product Name</th>
                
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
               
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
                
                <td>$<?php echo $result['price'];?></td>
                <td><?php echo $result['quantity'];?></td>
                
                <td>$<?php 
                  $total = $result['price'] * $result['quantity'];
                    echo $total;?></td>
                
              </tr>

              <?php 
                $qty = $qty + $result['quantity'];
                $sum = $sum + $total;

                Session::set("sum","$sum");
                Session::set("qty","$qty");
              ?>
              
              <?php } } ?>
            </table>
           
            <table class="tabletwo">
              <tr>
                <th>Sub Total : </th>
                <td>$<?php echo $sum; ?></td>
              </tr>
              <tr>
                <th>VAT : </th>
                <td>USD. 10% ($<?php echo $vat = $sum * 0.1; ?>) </td>
              </tr>
              <tr>
                <th>Grand Total :</th>
                <td>$<?php 
                  $grandtotal = $sum + $vat;
                  echo $grandtotal;
                  ?>
                </td>
              </tr>

              <tr>
                <th>Quantity:</th>
                <td><?php 
                     echo $qty;
                  ?>
                </td>
              </tr>
             </table>
          
          </div>



          <div class="division">
              
              <?php 
                $id = Session::get('cmrId');
                 $getCustomer = $cmr->customerData($id);
                 if($getCustomer){
                  while($result = $getCustomer->fetch_assoc()){
               ?> 
      
              <table class="tblone">
                <tr>
                  <td>Name</td>
                  <td>:</td>
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
					
    	</div>  	
       
    </div>
 </div>
   <div class="ordernow"><a href="?orderid=order">Order</a></div>
</div>
<?php include'partials/footer.php';?>

