<?php

class MessageHistoryArchive extends DBConnectionArchive{
    
     
  function __construct() {
       parent::__construct();
   }
   
       
      
      public  function getMessageHistoryCountsByMessageIdData($messageId,$tableName){
      $qry = "select  status,count(*) as counts "
               . " from $tableName where message_id = $messageId group by status " ;
      
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
      
      public function getMessagePartCountByMessageIdData($messageId,$tableName) {
        $row = null;
         
        try {
            $stmt = $this->connection->prepare("select sum(success_parts) as total from $tableName "
                    . "where message_id = ? ");
            $stmt->bind_param("i", $messageId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result != null && $result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("getMessagePartCountByMessageIdData error" . $e->getMessage());
        }
        return $row;
    }
      
       public  function getMessageHistoryByMessageAndMsisdnData($messageId,$msisdn,$tableName){
      $qry = "select * from $tableName where msisdn = $msisdn and message_id = $messageId  " ;
      
      $result = $this->connection->query($qry);
       $row = null;
      if ($result !=null && $result->num_rows > 0) {
        // output data of each row
        $row = $result->fetch_assoc()  ;
          
        
        }  
       
         return $row ;
       
      }
      
     
      
       
    
}
