<?php

class Vendor extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
     
      //  Insert new Vendor 
   
    public function addVendorData($name,$status,$address,$phone,$email,$desc,$userID) {

        $vendorId = 0;
        try {
           $stmt = $this->connection->prepare("insert into vendor"
              . "(name,status,address,phone,email,description,user_id) "
              . "values(?,?,?,?,?,?,?)");

            $stmt->bind_param("sissssi",$name,$status,$address,$phone,$email,$desc,$userID);
            $stmt->execute();
            
            if ($stmt->insert_id > 0) {
                $vendorId = $stmt->insert_id;
            } else {
                General::addError($stmt->error);
                General::writeEvent("addVendorData error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addVendorData ... error" . $e->getContent());
        }

        return $vendorId;
    }
 
      public  function getVendorsData(){
      $qry = "select * from vendor" ;
      
      $result = $this->connection->query($qry);
      
      if ($result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
         $table[] = $row;
        }
        return $table ;
        } else {
           return null ;
        }
        $this->connection->close();
       
      }
      
      public  function getVendorInfoData($vendorID){
      $qry = "select * from vendor where id = $vendorID " ;
      
      $result = $this->connection->query($qry);
      
      if ($result->num_rows > 0) {
        // output data of each row
          return $row = $result->fetch_assoc() ;
         
         } else {
           return null ;
        }
        $this->connection->close();
       
      }
      
        public function updateVendorData($id, $name, $address,$phone,$email,$desc) {

        $isUpdated = false ;
        try {
            $stmt = $this->connection->prepare("update vendor set name=?,address=?,phone=?,email=?,description=? "
                     . "  where id = ?")  ;

            $stmt->bind_param("sssssi",$name,$address,$phone,$email,$desc, $id);

            $stmt->execute();
            
             if ($stmt->affected_rows > 0  ) {
               $isUpdated = true ;
            } else {
              General::addError($stmt->error);
               General::writeEvent("updateVendorData error" . $stmt->error);
            }
          
            $stmt->close();
             
            
        } catch (Exception $e) {
            General::writeEvent("addContent ... error" . $e->getContent());
        }

        return $isUpdated;
    }
      
       
    
}
