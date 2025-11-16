<?php

class SendingTime extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
      
      public  function addSendingTimeData($serviceID,$attemp,$time){
      
      $isAdded = false  ;
      try {
          
        $stmt = $this->connection->prepare("insert into  content_send_time(sub_service_id,order_id,send_time) "
              . " values(?,?,?)")   ;
       
        $stmt->bind_param("iis",$serviceID,$attemp,$time) ;
        
        $stmt->execute();
       if($stmt->insert_id > 0){
            $isAdded = true ;
       }else {
          General::addError($stmt->error);
          General::writeEvent("addSendingTimeData error".$stmt->error);
       }
        $stmt->close();
        }catch(Exception $e) {
       General::writeEvent("addSendingTimeData ... error".$e->getMessage());
     }
      
        return $isAdded ;
      }
       
   
      
        public  function removeSendingTimeData($id){
           $rem_qry = "delete from  content_send_time where id = $id   " ;
           
            if ($this->connection->query($rem_qry) === TRUE) {
               return true ;
           } else {
               General::writeEvent("removeSendingTime-- error ".mysqli_error($this->connection));
               return false ;
      }
      
      }
    
      
       public  function getSendingTimeData($serviceID,$attemp){
         
      $qry = "select * from  content_send_time where sub_service_id = $serviceID and order_id = $attemp " ;
      
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
      
      public  function getSendingTimesData($serviceId){
      $qry = "select * from  content_send_time where sub_service_id = $serviceId  order by order_id  " ;
      
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
