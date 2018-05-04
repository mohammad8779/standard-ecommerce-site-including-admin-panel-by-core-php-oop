<?php 
   $filepath = realpath(dirname(__FILE__));
   
   include_once($filepath.'/../models/Database.php');
   include_once($filepath.'/../validation/Format.php');
   
?>


<?php 

  class Category{
    
    private $db;
    private $fm;


  	public function __construct(){

  		$this->db = new Database();
  		$this->fm = new Format();

  	}

  	public function catInsert($catName){

  		$catName = $this->fm->validation($catName);
  		

  		$catName = mysqli_real_escape_string($this->db->link, $catName);
  		

  		if( empty($catName) ){

  			$msg = "<h3 class='error'> Category Name must not be empty! </h3>";

  			return $msg ;

  		}

  		else{

  			$query = "INSERT INTO tbl_cat(catName) VALUES('$catName')";

  			$result = $this->db->insert($query);

  			if($result != false){
         
          $msg = "<h3 class='success'>Category inserted !</h3>";
          return $msg;
  				
  			}
  			else{
  				
           $msg = "<h3 class='error'>Category not inserted !</h3>";
           return $msg;

  			}
  		}

  	}

    public function catShow(){
      $query = "SELECT * FROM tbl_cat ORDER BY catId DESC";

      $result = $this->db->select($query);

      return $result;
    }

    public function catEdit($id){
      $query = "SELECT * FROM tbl_cat WHERE catId = '$id'";
      $result = $this->db->select($query);
      return $result;
    }


    public function updateCat($catName, $id){

      $catName = $this->fm->validation($catName);
      

      $catName = mysqli_real_escape_string($this->db->link, $catName);
      $id = mysqli_real_escape_string($this->db->link, $id);
      

      if( empty($catName) ){

        $msg = "<h3 class='error'> Category Name must not be empty! </h3>";

        return $msg ;

      }

      else{

        $query = "UPDATE tbl_cat
                  SET catName = '$catName'
                  WHERE catId='$id'
                 ";

        $result = $this->db->update($query);

        if($result != false){
         
          $msg = "<h3 class='success'>Category updated !</h3>";
          return $msg;
          
        }
        else{
          
           $msg = "<h3 class='error'>Category not updated!</h3>";
           return $msg;

        }
      }

    }

    public function catDelete($id){
      $query = "DELETE FROM tbl_cat WHERE catId = '$id'";

      $result = $this->db->delete($query);

        if($result != false){
         
          $msg = "<h3 class='success'>Category deleted !</h3>";
          return $msg;
          
        }
        else{
          
           $msg = "<h3 class='error'>Category not deleted!</h3>";
           return $msg;

        }
        
      }
    



}