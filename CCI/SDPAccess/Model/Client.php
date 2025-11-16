<?php

class Client extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
     
     //  Insert new client 
    public  function addClientData2($name,$login,$secret,$phone,$email,$status,$isActive,$vendorID,$userID){
      $password = md5($secret);
      $add_qry = "insert into client (name,login,secret,phone,email,status,isActive,creationDate,vendor_id,user_id) "
              . " values('$name','$login','$password','$phone','$email','$status','$isActive',NOW(),'$vendorID','$userID') " ;
       if ($this->connection->query($add_qry) === TRUE) {
            return true ;
      } else {
          General::writeEvent("addClient error ".mysqli_error($this->connection));
            return false ;
      }
      $this->connection->close();
      }
      
      public  function addClientData($name,$login,$secret,$phone,$email,$status,$isActive,$vendorID,$userType,$isApprove,$isAdmin,$userId){
       $id = 0 ;
       $secret = md5($secret);
      
    try {
      $stmt = $this->connection->prepare("insert into client (name,login,secret,phone,email,status,"
              . "isActive,creationDate,vendor_id,user_type,is_approve,is_admin,user_id)  "
              . "values(?,?,?,?,?,?,?,NOW(),?,?,?,?,?)") ;
      $stmt->bind_param("sssssiiiiiii",$name,$login,$secret,$phone,$email,$status,$isActive,$vendorID,$userType,$isApprove,$isAdmin,$userId);
      $stmt->execute();
      
       if($stmt->insert_id > 0){
          $id = $stmt->insert_id ;
      }else {
          General::addError($stmt->error);
          General::writeEvent("addClientData error".$stmt->error);
       }
      $stmt->close();
      
       return $id ;
    }catch(Exception $e) {
      General::writeEvent("addClientData error".$e->getMessage());
      return false ;
    }
    }
      
      
      public  function getClientsData(){
          
      $table = array();
      $qry = "select * from client" ;
      
      $result = $this->connection->query($qry);
      
      if ($result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
         array_push($table,$row);
        }
       
        } else {
           return null ;
        }
        $this->connection->close();
        
         return $table ;
       
      }
    
      
      public  function getClientsByVendorIdData($vendorId){
          
      $table = array();
      $stmt = $this->connection->prepare("select client.id,client.name,client.login,client.phone,"
              . "client.email,client.status,client.isActive,client.creationDate,client.vendor_id,"
              . "client.user_type,client.is_admin,client.is_approve from client where vendor_id = ?");
      $stmt->bind_param("i",$vendorId);
      $stmt->execute();
      $result = $stmt->get_result();
      
      if ($result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
         array_push($table,$row);
        }
        } else {
            General::writeEvent("getClientsByVendorIdData error".  mysqli_error($this->connection)) ; 
        }
        $this->connection->close();
        return $table ;
       
      }
     
      public  function getClientInfoByIdData($id){
      $qry = "select client.id ,client.login,client.name,client.secret,client.is_approve,client.isActive,client.phone,client.email,"
              . "client.vendor_id,vendor.private_key,vendor.public_key,vendor.address,"
              . "vendor.name as vendorName from client,vendor where client.id = $id and client.vendor_id =vendor.id" ;
      
      $result = $this->connection->query($qry);
       $row = null ;
      if($result != null){
      if ($result->num_rows > 0) {
         $row = $result->fetch_assoc() ;
          }  
        
       }
       $this->connection->close();
       return $row ;
      }
      
      
       public  function clientLoginData($login,$password){
      $pass = md5($password);  
        try {
         
      $stmt = $this->connection->prepare("select client.id ,client.name,client.user_type,client.is_admin,"
              . "vendor.name as vendorName,vendor.public_key from client,vendor where client.isActive =1 and client.login = ? and client.secret = ? and client.vendor_id=vendor.id ");
      $stmt->bind_param("ss",$login,$pass);
      $stmt->execute();
      $result = $stmt->get_result();
      
        $row = null ;
        if($result->num_rows > 0){
         $row = $result->fetch_assoc() ;
         }
       $stmt->close();
      
    }catch(Exception $e) {
      General::writeEvent("addUser error".$e->getMessage());
     }
     return $row ;
       
      }
      
       public  function updateClientData($id,$name,$login,$email,$phone){
           
       $upt_qry = "update client set name = '$name',login='$login',email='$email',phone='$phone' where id = $id  " ;
      
       $isUpdated = $this->connection->query($upt_qry) ;
       if ($isUpdated != TRUE) {
           General::writeEvent("updateUserData error ".mysqli_error($this->connection));
      }  
      $this->connection->close();
      
      return $isUpdated ;
      }
      
      
      public  function getClientInfoData($clientID){
      $qry = "select * from client where id = $clientID " ;
      
      $result = $this->connection->query($qry);
      
      if ($result->num_rows > 0) {
        // output data of each row
          return $row = $result->fetch_assoc() ;
         
         } else {
           return null ;
        }
        $this->connection->close();
       
      }
    public  function restClientPasswordData($password,$id){
       $secret = md5($password);
       $upt_qry = "update client set secret = '$secret' where id = $id  " ;
       General::writeEvent("sql ".$upt_qry);
       $isUpdated = $this->connection->query($upt_qry) ;
       if ($isUpdated != TRUE) {
           General::writeEvent("restClientPasswordData error ".mysqli_error($this->connection));
      }  
      $this->connection->close();
      
      return $isUpdated ;
      }
    
}
