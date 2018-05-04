<?php include'partials/header.php';?>
 <style>
  .payment{width: 450px;margin: 0 auto;border: 1px solid #ddd;text-align: center;min-height: 200px; margin-bottom:25px;}
  .payment h2{border-bottom: 1px solid #ddd;margin-bottom: 50px;}
  .payment a{background: #ff0000;padding: 10px 10px;font-size: 25px;margin-top: 28px;color: #fff;margin: 10px;}
  .previous{text-align:center;}
  .previous a{background: #000;padding: 15px;margin-top: 10px;font-size: 25px;color: #fff;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">	
    	   <div class="payment">
    	   	  <h2>Choice Your Payment</h2>
    	   	  <a href="payoffline.php">Offline Payment</a>
    	   	  <a href="payonline.php">Online Payment</a>
    	   </div>

    	   <div class="previous">
    	   	  <a href="cart.php">Previous</a>
    	   </div>
					
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include'partials/footer.php';?>

