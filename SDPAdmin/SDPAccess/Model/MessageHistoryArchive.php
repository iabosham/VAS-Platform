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
      
      
       public  function getTableIndexesData($fromDate,$toDate){
           
           $where = "";
           if($fromDate != null){
                $where.= " and creation_date >= '$fromDate' ";
           }
           
            if($toDate != null){
                $where.= " and creation_date <= '$toDate' ";
           }
           
           
           
       $qry = "select  *  from  table_index where status = 1  $where order by id  " ;
      
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
      
      
      
      
       public  function getHistoryMessageCountsData($stateId, $fromDate,$toDate,$tables,$resendCount,$companyId){
           
          
           $qry = "";
           
          //print_r($tables);
           
           if($tables != null){
               $total = count($tables) ;
               $count = 1;
               
               $qry.=" SELECT  sum(cn) counts, status , resend_count,status_name,operatorName,opId "
                       . " "
                          . "FROM ( "; 
               foreach($tables as $table){
                   
                   $tableName = $table['table_name'];
                    $where = "";
                    if($stateId > -1 ){
                         $where.= " and message_status.status_code = $stateId ";
                    }
                    
                     if($resendCount > -1 ){
                         $where.= " and $tableName.resend_count = $resendCount ";
                    }
                    
                    
                     if($companyId > 0 ){
                         $where.= " and shortcode.company_id = $companyId ";
                    }
                    
                    

                    if($fromDate != null){
                        // $where.= " and message.send_time_number >= unix_timestamp('$fromDate') ";
                    }

                     if($toDate != null){
                       //  $where.= " and message.send_time_number <= unix_timestamp('$toDate') ";
                    }

                
                 
                  $qry.= " select  count($tableName.id) cn ,$tableName.status,$tableName.resend_count,message_status.status_name "
                . ",operators.name as operatorName,operators.id as opId "
                . "from $tableName ,sdp_db.message_status, sdp_db.message,sdp_db.service,sdp_db.shortcode,sdp_db.operators "
                . ""
                . "where $tableName.status=message_status.status_code and $tableName.message_id=message.id  and message.service_id=service.id "
                . "and service.shortcode_id=shortcode.id and shortcode.company_id =operators.id  $where "
                . "  "
                 ;
                 
                 if($count < $total){
                     
                     $qry.=" UNION  ALL  " ; 
                     
                 }
                  
                  $count++; 
               }
                $qry.="  group by opId, resend_count , status  ) as tab" ; 
               
               $qry.="  group by opId, resend_count , status order by opId , resend_count, status    " ; 
               
           }
           
          
       
        
       if($qry != ""){
           
          
         $result = $this->connection->query($qry);
          //print_r($this->connection);
        }else {
         $result =null;   
           
       }
       
         
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
