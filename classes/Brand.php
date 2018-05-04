<?php 
   $filepath = realpath(dirname(__FILE__));
    
   include_once($filepath.'/../models/Database.php');
   include_once($filepath.'/../validation/Format.php');
  
?>




<?php class Brand{
    
    private $db;
    private $fm;


  	public function __construct(){

  		$this->db = new Database();
  		$this->fm = new Format();

  	}

  	public function brandInsert($brandName){

  		$brandName = $this->fm->validation($brandName);
  		

  		$brandName = mysqli_real_escape_string($this->db->link, $brandName);
  		

  		if( empty($brandName) ){

  			$msg = "<h3 class='error'> Brand Name must not be empty! </h3>";

  			return $msg ;

  		}

  		else{

  			$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";

  			$result = $this->db->insert($query);

  			if($result != false){
         
          $msg = "<h3 class='success'>Brand inserted !</h3>";
          return $msg;
  				
  			}
  			else{
  				
           $msg = "<h3 class='error'>Brand not inserted !</h3>";
           return $msg;

  			}
  		}

  	}

    public function brandShow(){
      $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";

      $result = $this->db->select($query);

      return $result;
    }

    public function brandEdit($id){
      $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
      $result = $this->db->select($query);
      return $result;
    }


    public function updateBrand($brandName, $id){

      $brandName = $this->fm->validation($brandName);
      

      $brandName = mysqli_real_escape_string($this->db->link, $brandName);
      $id = mysqli_real_escape_string($this->db->link, $id);
      

      if( empty($brandName) ){

        $msg = "<h3 class='error'> Brand Name must not be empty! </h3>";

        return $msg ;

      }

      else{

        $query = "UPDATE tbl_brand
                  SET brandName = '$brandName'
                  WHERE brandId='$id'
                 ";

        $result = $this->db->update($query);

        if($result != false){
         
          $msg = "<h3 class='success'>Brand updated !</h3>";
          return $msg;
          
        }
        else{
          
           $msg = "<h3 class='error'>Brand not updated!</h3>";
           return $msg;

        }
      }

    }

    public function brandDelete($id){
      $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";

      $result = $this->db->delete($query);

        if($result != false){
         
          $msg = "<h3 class='success'>Brand deleted !</h3>";
          return $msg;
          
        }
        else{
          
           $msg = "<h3 class='error'>Brand not deleted!</h3>";
           return $msg;

        }
      }
    



}