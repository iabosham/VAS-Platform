<?php

class ContentSendTime extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
      
      public  function addContentSendTimeData($serviceID,$attemp,$time){
      
      $isAdded = false  ;
      try {
          
        $stmt = $this->connection->prepare("insert into resend_message_config(service_id,attemp_number,send_time) "
              . " values(?,?,?)")   ;
       
        $stmt->bind_param("iis",$serviceID,$attemp,$time) ;
        
        $stmt->execute();
       if($stmt->insert_id > 0){
            $isAdded = true ;
       }else {
          General::addError($stmt->error);
          General::writeEvent("addContentSendTimeData error".$stmt->error);
       }
        $stmt->close();
        }catch(Exception $e) {
       General::writeEvent("addContentSendTimeData ... error".$e->getMessage());
     }
      
        return $isAdded ;
      }
       
   
      
        public  function removeContentSendTime($id){
           $rem_qry = "delete from resend_message_config where id = $id   " ;
           
            if ($this->connection->query($rem_qry) === TRUE) {
               return true ;
           } else {
               General::writeEvent("removeContentSendTime-- error ".mysqli_error($this->connection));
               return false ;
      }
      
      }
    
      
     public  function getContentSendTimeData($orderID){
         
      $qry = "select * from content_send_time where order_id = $orderID  " ;
      
      $result = $this->connection->query($qry);
      
       
      $row = null ;
      if($result != null){
       if ($result->num_rows > 0) {
        // output data of each row
         $row = $result->fetch_assoc() ;
         
         } 
         }  
        return $row ;
       
      }
      
      public  function getContentSendTimesData($serviceId){
      $qry = "select * from resend_message_config where service_id = $serviceId  order by attemp_number  " ;
      
      $result = $this->connection->query($qry);
       $table = array();
      if ($result !=null && $result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
         array_push($table,$row);
         }
        }  
          return $table ;
       
      }
       
    
}
