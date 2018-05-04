<?php 
   $filepath = realpath(dirname(__FILE__));
   
   include_once($filepath.'/../models/Database.php');
   include_once($filepath.'/../validation/Format.php');
   
?>



<?php 
	
	class Customer{

	private $db;
  private $fm;


  	public function __construct(){

  		$this->db = new Database();
  		$this->fm = new Format();

  	}


    public function customerRegistration($data){

      $name     = mysqli_real_escape_string($this->db->link, $data['name']);
      $address  = mysqli_real_escape_string($this->db->link, $data['address']);
      $city     = mysqli_real_escape_string($this->db->link, $data['city']);
      $country  = mysqli_real_escape_string($this->db->link, $data['country']);
      $zip      = mysqli_real_escape_string($this->db->link, $data['zip']);
      $phone    = mysqli_real_escape_string($this->db->link, $data['phone']);
      $email    = mysqli_real_escape_string($this->db->link, $data['email']);
      $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

      
      

      if( $name == "" || $address == "" || $city == ""|| $country == "" || $zip == ""|| $phone == "" || $email == "" || $password == "" ) {

           $msg = "<span class='error'>fields must not be empty !</span>";
           return $msg;
        }

        $mailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
        $mailresult = $this->db->select($mailquery);
      
      if($mailresult != false){
        $msg = "Email allready added!";
        return $msg;
      }

      else{

    $query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, password)VALUES('$name', '$address', '$city', '$country', '$zip', '$phone', '$email', '$password')";
        $inserted_rows = $this->db->insert($query);
        if ($inserted_rows) {
         echo "<span class='success'>Customer Inserted Successfully.
         </span>";
        }else {
         echo "<span class='error'>Customer Not Inserted !</span>";
         }

        
      }
      
      
    }


    public function customerLogin($data){

       $email    = mysqli_real_escape_string($this->db->link, $data['email']);
       $password = mysqli_real_escape_string($this->db->link, md5($data['password']));


      if( empty($email) || empty($password )){

         $msg = "<span class='error'>fields must not be empty !</span>";
           return $msg;
      } 

      $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
        $result = $this->db->select($query);
      
      if($result != false){
        $value = $result->fetch_assoc();
        Session::set("cmrLogin", true);
        Session::set("cmrId", $value['id']);
        Session::set("cmrName", $value['name']);
        header("Location: cart.php");
      }else{
        $msg = "<span class='error'>Email And Password  not  matched!</span>";
        return $msg;
      }
    }

    public function customerData($id){
      $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
      $result = $this->db->select($query);
      return $result;
    }

    public function customerUpdate($data,$cmrId){

      $name     = mysqli_real_escape_string($this->db->link, $data['name']);
      $address  = mysqli_real_escape_string($this->db->link, $data['address']);
      $city     = mysqli_real_escape_string($this->db->link, $data['city']);
      $country  = mysqli_real_escape_string($this->db->link, $data['country']);
      $zip      = mysqli_real_escape_string($this->db->link, $data['zip']);
      $phone    = mysqli_real_escape_string($this->db->link, $data['phone']);
      $email    = mysqli_real_escape_string($this->db->link, $data['email']);
     

      
      

      if( $name == "" || $address == "" || $city == ""|| $country == "" || $zip == ""|| $phone == "" || $email == "" ) {

           $msg = "<span class='error'>fields must not be empty !</span>";
           return $msg;
        }

       

      else{
            $query = "UPDATE tbl_customer
                SET 
                name = '$name',
                address      = '$address',
                city    = '$city',
                country       = '$country',
                zip       = '$zip',
                email      = '$email'
               
                WHERE id = '$cmrId' ";
          $updated_row = $this->db->update($query);
          if ($updated_row) {
           echo "<span class='success'>Customer Updated Successfully.
           </span>";
          }else {
           echo "<span class='error'>Customer Not Updated !</span>";
           }

        
      }
      
       

    }




}



?>