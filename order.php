<?php include'partials/header.php';?>
<?php 
  $login = Session::get("cmrLogin");
  if($login == false){
  		header("Location:login.php");
  }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">		
			<h1>welcome to order page</h1>
					
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include'partials/footer.php';?>

