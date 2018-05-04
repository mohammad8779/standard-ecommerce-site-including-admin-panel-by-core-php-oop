<?php 
   
   include'models/Session.php';
   Session::init();

   include'models/Database.php';
   include'validation/Format.php';

   spl_autoload_register(function($class){
   		include_once"classes/".$class.".php";
   });

   $db   = new Database();
   $fm   = new Format();
   $pd   = new Product();
   $cat  = new Category();
   $ct   = new Cart();
   $cmr   = new Customer();
   
   
?>   

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>


<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
								<?php 
								    $getData = $ct->checkCart();
								    if($getData){
									$sum = Session::get("sum");
									$qty = Session::get("qty");
									echo "$".$sum." | Qty: ".$qty;
								    }
								    else{
								    	echo "(empty)";
								    }
								?>
							   </span>
							</a>
						</div>
			      </div>
		   <div class="login">
            <?php 

            	if(isset($_GET['cmrid'])){
            		$delcart = $ct->delCustomercart();
            		$cmrId = Session::get("cmrId");
            		$delcompare = $pd->delComparedata($cmrId);
            		Session::destroy();
            	}
            ?> 
		   	<?php 
               $login = Session::get("cmrLogin");
               if($login == false){ ?>
  		            <a href="login.php">Login</a>
            <?php } else{ ?>
                    <a href="?cmrid=<?php Session::get('cmrId')?>">Logout</a>

            <?php } ?>        


		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	  
      
      <?php 
        $chkcart = $ct->checkCart();
         if($chkcart){  ?>
         	 <li><a href="cart.php">Cart</a></li>
         	 <li><a href="payment.php">Payment</a></li>
       <?php } ?>

     
	  <?php 
	    $cmrId = Session::get("cmrId");
        $chkorder = $ct->checkOrder($cmrId);
         if($chkorder){  ?>
         	 
         	 <li><a href="orderdetails.php">Order Details</a></li>
       <?php } ?>


	  <?php 
	     $customerlogin = Session::get("cmrLogin");
         if($customerlogin == true){  ?>
         	 <li><a href="profile.php">Profile</a></li>
       <?php } ?>
	 
	 <?php 
         $cmrId = Session::get('cmrId');
           $getallComparepro = $pd->getComparedata($cmrId);
              if($getallComparepro){
       ?> 
          <li><a href="compare.php">Compare</a></li>
	      

	   <?php } ?> 

     <?php 
         $cmrId = Session::get('cmrId');
           $getallWishlistpro = $pd->getWishlistdata($cmrId);
              if($getallWishlistpro){
       ?> 
          <li><a href="wishlist.php">Wishlist</a></li>
        

     <?php } ?>    
	   


	   <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>