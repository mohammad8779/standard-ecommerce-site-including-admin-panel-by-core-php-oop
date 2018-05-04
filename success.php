<?php include'partials/header.php';?>
 <style>
  .psuccess{width:550px;margin:0 auto; border:1px solid #ddd; padding: 30px;}
  .psuccess h2{text-align: center;border-bottom:1px solid #ddd;}
  .psuccess p{margin-top:20px; text-transform: capitalize;}
  
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">	
    	   <div class="psuccess">
    	   	  <h2>Success</h2>
            <?php 

              $cmrId = Session::get('cmrId');
              $amount = $ct->payableAmount($cmrId);
              if($amount){

                $sum = 0;

                while($result = $amount->fetch_assoc()){

                  $price = $result['price'];

                  $sum = $sum+$price;

                }

              }


            ?>
            <p style="color:red;">Total payable amount (including vat):$
              <?php
                $vat   = $sum*0.1;
                $total = $sum+$vat;
                echo $total;
              ?>
              
            </p>
            <p>thanks for purchases.Reacive your order successfully.we will contact you asap with delivery details.Here is your order details...<a href="orderdetails.php">Visit Here</a></p>
    	   	  
    	   </div>

    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include'partials/footer.php';?>

