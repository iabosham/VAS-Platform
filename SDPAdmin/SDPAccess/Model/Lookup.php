<?php
class Lookup extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
    public  function getStatusLookupData(){
        
      $qry = "select * from message_status " ;
      
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
       