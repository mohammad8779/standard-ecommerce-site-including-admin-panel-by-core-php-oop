<?php 

   $filepath = realpath(dirname(__FILE__));
   
   include_once($filepath.'/../models/Database.php');
   include_once($filepath.'/../validation/Format.php');
   
?>



<?php 
	
	class Cart{

	private $db;
  private $fm;


  public function __construct(){

  	$this->db = new Database();
  	$this->fm = new Format();

  }



  public function addTocart($quantity, $id){

     $quantity  = $this->fm->validation($quantity);
     $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
     $productId = mysqli_real_escape_string($this->db->link, $id);
     $sessionId = session_id();

     $squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
     $result = $this->db->select($squery)->fetch_assoc();
     
     $productName = $result['productName'];
     $price       = $result['price'];
     $image       = $result['image'];

     $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sessionId = '$sessionId'";

     $getPro = $this->db->select($chquery);
     if($getPro){
       $msg = "<span class='error'>product allready added.</span>";
       return $msg;
     }

     else{

     $query = "INSERT INTO tbl_cart(sessionId, productId, productName, price, quantity, image) 
        VALUES('$sessionId', '$productId','$productName', '$price','$quantity','$image')";
        
        $inserted_rows = $this->db->insert($query);
        if ($inserted_rows) {
           header("Location: cart.php");
        }else {
           header("Location: 404.php"); 
         }
      }
     
   }

   public function cartProduct(){
      $sessionId = session_id();
      $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
      $result = $this->db->select($query);
      return $result;
   }

   public function updateCartquantuty($quantity, $cartId){

       $cartId = mysqli_real_escape_string($this->db->link, $cartId);
       $quantity = mysqli_real_escape_string($this->db->link, $quantity);

       $query = "UPDATE tbl_cart
                  SET quantity = '$quantity'
                  WHERE cartId='$cartId'
                 ";

        $result = $this->db->update($query);

        if($result != false){
         
         // $msg = "<h3 class='success'>Quantity updated !</h3>";
         // return $msg;
          header("Location:cart.php");
          
        }
        else{
          
           $msg = "<h3 class='error'>Quantity not updated!</h3>";
           return $msg;

        }
   }

   public function productdeleteByid($delid){
      $query = "DELETE FROM tbl_cart WHERE cartId = '$delid'";

      $result = $this->db->delete($query);

        if($result != false){
         
          echo "<script>window.location : 'cart.php'</script>";
          
        }
        else{
          
           $msg = "<h3 class='error'>Product not deleted!</h3>";
           return $msg;

        }
   }

   public function checkCart(){
      $sessionId = session_id();

      $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
      $result = $this->db->select($query);
      return $result;

   }

   public function delCustomercart(){
     $sessionId = session_id();

     $query = "DELETE FROM tbl_cart WHERE sessionId = '$sessionId'";
     $this->db->delete($query);
   }

   //transfer product from cart table to order table for processing order

   public function insertOrderfromcarttbl($cmrId){

      $sessionId = session_id();
      $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
      $getProduct = $this->db->select($query);
      
      if($getProduct){
          while($result = $getProduct->fetch_assoc()){
              $productId   =  $result['productId'];
              $productName =  $result['productName'];
              $quantity    =  $result['quantity'];
              $price       =  $result['price']*$quantity;
              $image       =  $result['image'];

              //insert in to order table in while loop
              $query = "INSERT INTO tbl_order(cmrId, productId, productName, quantity, price, image) 
        VALUES('$cmrId', '$productId','$productName','$quantity', '$price','$image')";
        
              $inserted_rows = $this->db->insert($query);
            }

      }

   }

   public function payableAmount($cmrId){
      $query = "SELECT price FROM tbl_order WHERE cmrId = '$cmrId' And date = now()";
      $result = $this->db->select($query);
      return $result;
   }


   public function getOrderProduct($cmrId){

      $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY productId DESC";
      $result = $this->db->select($query);
      return $result;

   }

   public function checkOrder($cmrId){

      $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
      $result = $this->db->select($query);
      return $result;

   }

   public function getAllorderproduct(){
     $query = "SELECT * FROM tbl_order ORDER BY date DESC";
      $result = $this->db->select($query);
      return $result;
   }

   public function productShifted($id,$date,$price){

       $id = mysqli_real_escape_string($this->db->link, $id);
       $date = mysqli_real_escape_string($this->db->link, $date);
       $price = mysqli_real_escape_string($this->db->link, $price);

       $query = "UPDATE tbl_order
                  SET status = '1'
                  WHERE cmrId='$id' AND date ='$date' AND price ='$price'
                 ";

        $result = $this->db->update($query);

        if($result != false){
         
          $msg = "<h3 class='success'>updated successfully !</h3>";
          return $msg;
          
        }
        else{
          
           $msg = "<h3 class='error'>not updated!</h3>";
           return $msg;

        }
   }

   public function delShiftedProduct($id,$date,$price){
       $id = mysqli_real_escape_string($this->db->link, $id);
       $date = mysqli_real_escape_string($this->db->link, $date);
       $price = mysqli_real_escape_string($this->db->link, $price);

       $query = "DELETE FROM tbl_order WHERE cmrId='$id' AND date ='$date' AND price ='$price' ";

       $result = $this->db->delete($query);

        if($result != false){
         
          $msg = "<h3 class='success'>Order Product Deleted !</h3>";
          return $msg;
          
        }
        else{
          
           $msg = "<h3 class='error'>Order Product Not Deleted!</h3>";
           return $msg;

        }
   }

   public function updateproductShifted($id,$date,$price){
       $id = mysqli_real_escape_string($this->db->link, $id);
       $date = mysqli_real_escape_string($this->db->link, $date);
       $price = mysqli_real_escape_string($this->db->link, $price);

       $query = "UPDATE tbl_order
                  SET status = '2'
                  WHERE cmrId='$id' AND date ='$date' AND price ='$price'
                 ";

        $result = $this->db->update($query);

        if($result != false){
         
          $msg = "<h3 class='success'>updated shifted successfully !</h3>";
          return $msg;
          
        }
        else{
          
           $msg = "<h3 class='error'>shifted not updated!</h3>";
           return $msg;

        }
   }

}



?>