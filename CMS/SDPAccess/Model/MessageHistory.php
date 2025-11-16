<?php

class MessageHistory extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
     
     //  Insert new message_history 
    public  function addMessageHistoryData($messageID ,$subscriberID,$resultID){
      $add_qry = "insert into message_history(message_id,subscriber_id,result_id) "
              . " values('$messageID','$subscriberID','$resultID') " ;
      
      $isAdded = $this->connection->query($add_qry) ;
      
       if ($isAdded != TRUE) {
            General::writeEvent("addMessageHistory-- error ".mysqli_error($this->connection));
      }
      
      $this->connection->close();
      return $isAdded ;
      }
       
      
      public  function getMessageHistoryByMessageIdData($messageId){
      $qry = "select  subscriber.msisdn,message_history.status,message_history.creationDate as send_time"
               . " from message_history,subscriber where  message_history.subscriber_id=subscriber.id and "
               . "message_id = $messageId  " ;
      
      $result = $this->connection->query($qry);
      $table = array();
      if ($result !=null && $result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
         array_push($table,$row);
         }
        }  
        $this->connection->close();
         return $table ;
       
      }
      
      public  function getMessageHistoryCountsByMessageIdData($messageId){
      $qry = "select  resend_count,count(*) as counts "
               . " from message_history where message_id = $messageId group by resend_count " ;
      
      $result = $this->connection->query($qry);
       $table = array();
      if ($result !=null && $result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
         array_push($table,$row);
         }
        }  
        $this->connection->close();
         return $table ;
       
      }
      
       public  function getMessageHistoryInfoByNumberData($number){
      $qry = "select * from message_history  "
              . "where message_history.number = $number " ;
      
      $result = $this->connection->query($qry);
      
      if ($result->num_rows > 0) {
        // output data of each row
         $row = $result->fetch_assoc() ;
          return $row ;
        } else {
           return null ;
        }
        $this->connection->close();
       
      }
      
       
    
}
