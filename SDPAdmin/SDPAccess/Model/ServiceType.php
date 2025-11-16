<?php

class ServiceType extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
     
     //  Insert new service_type 
    public  function addServiceTypeData($name ,$code,$userID){
      $add_qry = "insert into service_type (name,service_type_code,user_id) "
              . " values('$name','$code','$userID') " ;
       if ($this->connection->query($add_qry) === TRUE) {
            return true ;
      } else {
         General::writeEvent("addServiceType  error ".mysqli_error($this->connection));
            return false ;
      }
      $this->connection->close();
      }
       
      
      public  function getServiceTypesData(){
      $qry = "select service_type.id,service_type.name,service_type.service_type_code,"
              . "user.name as userName  "
              . "from service_type,user "
              . "where service_type.user_id=user.id " ;
      
      $result = $this->connection->query($qry);
      
        if($result != null ){ 
      if ($result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
         $table[] = $row;
        }
        return $table ;
        } else {
           return null ;
        }
      } else {
           return null ;
      }
        $this->connection->close();
       
      }
      
       public  function getAllServiceTypesData(){
      $qry = "select * from service_type " ;
       
      $result = $this->connection->query($qry);
      
      if($result != null ){ 
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
         $table[] = $row;
        }
        return $table ;
        } else {
           return null ;
        }
      }else {
           return null ;  
      }
       $this->connection->close();
       
      }
      
       public  function getServiceTypeInfoByCodeData($code){
      $qry = "select * from service_type  "
              . "where service_type_code = $code " ;
      
      $result = $this->connection->query($qry);
      if($result != null ){ 
      if ($result->num_rows > 0) {
        // output data of each row
         $row = $result->fetch_assoc() ;
          return $row ;
        } else {
           return null ;
        }
        
      }else {
         return null ;    
      }
        $this->connection->close();
       
      }
      
}
      
       