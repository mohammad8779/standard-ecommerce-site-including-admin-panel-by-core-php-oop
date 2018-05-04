<?php 
   $filepath = realpath(dirname(__FILE__));
   
   include_once($filepath.'/../models/Database.php');
   include_once($filepath.'/../validation/Format.php');
   
?>

<?php 

   
   class Product {
       
       private $db;
       private $fm;

       public function __construct(){

  		$this->db = new Database();
  		$this->fm = new Format();

  	}


  	public function createProduct($data, $file){

  		$productName = $this->fm->validation($data['productName']);
  		$productName = mysqli_real_escape_string($this->db->link, $productName);
  		$catId = $this->fm->validation($data['catId']);
  		$catId = mysqli_real_escape_string($this->db->link, $catId);
  		$brandId = $this->fm->validation($data['brandId']);
  		$brandId = mysqli_real_escape_string($this->db->link, $brandId);
  		$body = $this->fm->validation($data['body']);
  		$body = mysqli_real_escape_string($this->db->link, $body);
  		$price = $this->fm->validation($data['price']);
  		$price = mysqli_real_escape_string($this->db->link, $price);
  		$type = $this->fm->validation($data['type']);
  		$type = mysqli_real_escape_string($this->db->link, $type);

        //image or file upload
	  	$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if ($productName == "" || $catId == ""|| $brandId == ""|| $body == "" || $price == ""|| $file_name == "" || $type = "") {
	     $msg = "<span class='error'>fields must not be empty !</span>";
	     return $msg;
	    }elseif ($file_size >1048567) {
	     $msg = "<span class='error'>Image Size should be less then 1MB!
	     </span>";
	     return $msg;
	    } elseif (in_array($file_ext, $permited) === false) {
	     echo "<span class='error'>You can upload only:-"
	     .implode(', ', $permited)."</span>";
	    } else{
		    move_uploaded_file($file_temp, $uploaded_image);
		    $query = "INSERT INTO tbl_product(productName,catId,brandId,price,body,image,type) 
		    VALUES('$productName','$catId','$brandId','$price','$body','$uploaded_image','type')";
		    $inserted_rows = $this->db->insert($query);
		    if ($inserted_rows) {
		     echo "<span class='success'>Product Inserted Successfully.
		     </span>";
		    }else {
		     echo "<span class='error'>Product Not Inserted !</span>";
	       }
	    }
	  		
	}


	public function showProduct(){
		$query = "SELECT p.*,c.catName,b.brandName
					FROM tbl_product as p, tbl_cat as c, tbl_brand b
					WHERE p.catId = c.catId AND p.brandId = b.brandId
					ORDER BY p.productId DESC
		         ";

   	    /*
   	    $query = "SELECT tbl_product.*,tbl_cat.catName,tbl_brand.brandName
   	    			FROM tbl_product
   	    		    INNER JOIN tbl_cat
   	    		    ON tbl_product.catId = tbl_cat.catId
   	    		    INNER JOIN tbl_brand
   	    		    ON tbl_product.brandId = tbl_brand.brandId
   	    		    ORDER BY tbl_product.productId DESC	
   	             ";
		*/
   	    $result = $this->db->select($query);

   	    return $result;
      }


    public function editProduct($id){
    	$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }  


    public function updateProduct($data, $file, $id){


    	$productName = $this->fm->validation($data['productName']);
  		$productName = mysqli_real_escape_string($this->db->link, $productName);
  		$catId = $this->fm->validation($data['catId']);
  		$catId = mysqli_real_escape_string($this->db->link, $catId);
  		$brandId = $this->fm->validation($data['brandId']);
  		$brandId = mysqli_real_escape_string($this->db->link, $brandId);
  		$body = $this->fm->validation($data['body']);
  		$body = mysqli_real_escape_string($this->db->link, $body);
  		$price = $this->fm->validation($data['price']);
  		$price = mysqli_real_escape_string($this->db->link, $price);
  		$type = $this->fm->validation($data['type']);
  		$type = mysqli_real_escape_string($this->db->link, $type);

        //image or file upload
	  	$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if ($productName == "" || $catId == ""|| $brandId == ""|| $body == "" || $price == ""|| $type = "") {
	     $msg = "<span class='error'>fields must not be empty !</span>";
	     return $msg;
	    }

	    else{ 
          
          if(!empty($file_name)){ 

		    if($file_size > 1048567) {
		     $msg = "<span class='error'>Image Size should be less then 1MB!
		     </span>";
		     return $msg;
		    } elseif(in_array($file_ext, $permited) === false) {
		     echo "<span class='error'>You can upload only:-"
		     .implode(', ', $permited)."</span>";
		    } 

		   else{
			    move_uploaded_file($file_temp, $uploaded_image);
			    
			    $query = "UPDATE tbl_product
			    			SET 
			    			productName = '$productName',
			    			catId       = '$catId',
			    			brandId     = '$brandId',
			    			price       = '$price',
			    			body        = '$body',
			    			image       = '$uploaded_image',
			    			type        = '$type'
			    			WHERE productId = '$id' ";
			    $updated_row = $this->db->insert($query);
			    if ($updated_row) {
			     echo "<span class='success'>Product Updated Successfully.
			     </span>";
			    }else {
			     echo "<span class='error'>Product Not Updated !</span>";
		       }
		    }

		} else{


			    
			    $query = "UPDATE tbl_product
			    			SET 
			    			productName = '$productName',
			    			catId       = '$catId',
			    			brandId     = '$brandId',
			    			price       = '$price',
			    			body        = '$body',
			    			type        = '$type'
			    			WHERE productId = '$id' ";
			    $updated_row = $this->db->insert($query);
			    if ($updated_row) {
			     echo "<span class='success'>Product Updated Successfully.
			     </span>";
			    }else {
			     echo "<span class='error'>Product Not Updated !</span>";
		       }

		}

     }



   }


   public function productDelete($id){

   		$delquery = "SELECT * FROM tbl_product WHERE productId = '$id'";
   		$getdata = $this->db->select($delquery);
   		if($getdata){ 
	   		while($getimg = $getdata->fetch_assoc()){
	   			$imglink = $getimg['image'];
	            unlink($imglink);
	   		}
   	    }

   		$query = "DELETE FROM tbl_product WHERE productId = '$id' ";
   		$result = $this->db->delete($query);

   		if($result != false){
         
          $msg = "<h3 class='success'>Product deleted !</h3>";
          return $msg;
          
        }
        else{
          
           $msg = "<h3 class='error'>Product not deleted!</h3>";
           return $msg;

        }
   		
   		




   }

   public function indexFpro(){
   	 $query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 4";

   	 $result = $this->db->select($query);

   	 return $result;
   }

   public function indexNpro(){
   	 $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";

   	 $result = $this->db->select($query);

   	 return $result;
   }

   public function getSinglePro($id){

   		$query = "SELECT p.*,c.catName,b.brandName
					FROM tbl_product as p, tbl_cat as c, tbl_brand b
					WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$id'";

   	     $result = $this->db->select($query);

   	     return $result;

   }

   public function getIphonePro(){
   	 $query = "SELECT * FROM tbl_product WHERE brandId = '6' ORDER BY productId DESC LIMIT 1";
     $result = $this->db->select($query);
     return $result;
   }

   public function getSamsungPro(){
   	 $query = "SELECT * FROM tbl_product WHERE brandId = '7' ORDER BY productId DESC LIMIT 1";
     $result = $this->db->select($query);
     return $result;
   }

   public function getAcerPro(){
   	 $query = "SELECT * FROM tbl_product WHERE brandId = '8' ORDER BY productId DESC LIMIT 1";
     $result = $this->db->select($query);
     return $result;
   }

   public function getCanonPro(){
   	 $query = "SELECT * FROM tbl_product WHERE brandId = '9' ORDER BY productId DESC LIMIT 1";
     $result = $this->db->select($query);
     return $result;
   }

   public function showProbycategory($id){
       $catId = mysqli_real_escape_string($this->db->link, $id);
       $query = "SELECT * FROM tbl_product WHERE catId  = '$catId'";
        $result = $this->db->select($query);
        return $result;
   }

   public function insertCompareproducts($compareId,$cmrId){

      $productId = mysqli_real_escape_string($this->db->link, $compareId);
      $cmrId    = mysqli_real_escape_string($this->db->link, $cmrId);

         $comparequery = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' AND productId = '$productId' ";
         $checkCompare = $this->db->select($comparequery);
          if($checkCompare){
                $msg = "<h3 class='error'>Compare Already Added!</h3>";
                 return $msg;
           }

         $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
         $getCompare = $this->db->select($query)->fetch_assoc();
      
      if($getCompare){
              
               $productId = $getCompare['productId'];
               $productName = $getCompare['productName'];
               $price = $getCompare['price'];
               $image = $getCompare['image'];
               

              //insert in to compare table in while loop
              $query = "INSERT INTO tbl_compare(cmrId, productId, productName, price, image) 
        VALUES('$cmrId', '$productId','$productName','$price','$image')";
        
              $inserted_rows = $this->db->insert($query);


                if($inserted_rows){
         
                 $msg = "<h3 class='success'>added to compare!</h3>";
                 return $msg;
          
                }
                else{
                  
                   $msg = "<h3 class='error'>not added to compare!</h3>";
                   return $msg;

                }
              }
            }

    public function getComparedata($cmrId){
      $query = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' ORDER BY id DESC";

      $result = $this->db->select($query);
      return $result;
    }

    public function delComparedata($cmrId){
      $query = "DELETE FROM tbl_compare WHERE cmrId = '$cmrId' ";
      $result = $this->db->delete($query);
      return $result;
    }
 //for saving in wishlist
   public function insertWishlistproducts($wishlistId,$cmrId){

      $productId = mysqli_real_escape_string($this->db->link, $wishlistId);
      $cmrId    = mysqli_real_escape_string($this->db->link, $cmrId);

         $wlistquery = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$productId' ";
         $checkWlist = $this->db->select($wlistquery);
          if($checkWlist){
                $msg = "<h3 class='error'>Wishlist Already Added!</h3>";
                 return $msg;
           }

         $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
         $getWish = $this->db->select($query)->fetch_assoc();
      
      if($getWish){
              
               $productId = $getWish['productId'];
               $productName = $getWish['productName'];
               $price = $getWish['price'];
               $image = $getWish['image'];
               

              //insert in to compare table in while loop
              $query = "INSERT INTO tbl_wlist(cmrId, productId, productName, price, image) 
        VALUES('$cmrId', '$productId','$productName','$price','$image')";
        
              $inserted_rows = $this->db->insert($query);


                if($inserted_rows){
         
                 $msg = "<h3 class='success'>added to wishlist!</h3>";
                 return $msg;
          
                }
                else{
                  
                   $msg = "<h3 class='error'>not added to wishlist!</h3>";
                   return $msg;

                }
              }
           }

     public function getWishlistdata($cmrId){
      $query = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' ORDER BY id DESC";

      $result = $this->db->select($query);
      return $result;
    }


    public function deleteWlistpro($productId,$cmrId){
      $query = "DELETE FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$productId'";
      $result = $this->db->delete($query);
      return $result;
    }

     

}

?>
