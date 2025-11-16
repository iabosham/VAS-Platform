<?php

class Sender extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
     
     //  Insert new sender 
    public  function addSenderData($name ,$shortcodeId,$userID){
      $add_qry = "insert into sender (name,shortcode_id,user_id) "
              . " values('$name','$shortcodeId','$userID') " ;
       if ($this->connection->query($add_qry) === TRUE) {
            return true ;
      } else {
         General::writeEvent("addSender  error ".mysqli_error($this->connection));
            return false ;
      }
      $this->connection->close();
      }
       
      
      public  function getSendersByShortcodeIdData($shortcodeId){
      $qry = "select sender.name as senderName,user.name as userName from sender,user "
              . "where sender.user_id=user.id and sender.shortcode_id = $shortcodeId" ;
      
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
      
       public  function getAllSendersData(){
      $qry = "select * from sender " ;
       
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
      
       public  function getSenderInfoByCodeData($code){
      $qry = "select * from sender  "
              . "where sender_code = $code " ;
      
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
      
       