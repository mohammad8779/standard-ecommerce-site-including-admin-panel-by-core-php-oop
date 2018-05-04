<?php include'partials/header.php';?>
<?php 
  $login = Session::get("cmrLogin");
  if($login == true){
  		header("Location:order.php");
  }
?>

<?php 

if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration']) ){
      
      $cmrRegistration = $cmr ->customerRegistration($_POST);
   }

?>
<?php 
  
  if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cmrlogin']) ){
      
      $cmrlogin = $cmr ->customerLogin($_POST);
   }
?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<?php 
    			if(isset($cmrlogin)){
    				echo $cmrlogin;
    			}
    		?>
        	<form action="" method="post">
                	<input name="email" type="text" class="field" placeholder="Email">
                    <input name="password" placeholder="Password" type="password">
                    
                
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><button name="cmrlogin" class="grey">Sign In</button></div></div>
             </form>        
                    </div>
    	<div class="register_account">
    		<?php 
    			if(isset($cmrRegistration)){
    				echo $cmrRegistration;
    			}
    		?>
    		<h3>Register New Account</h3>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Zip Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="Email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
		    			<input type="text" name="country" placeholder="Country">
						
				    </div>		        
	
		           <div>
		              <input type="text" name="phone" placeholder="Phone">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div ><button name="registration" class="grey">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
   <?php include'partials/footer.php';?>

