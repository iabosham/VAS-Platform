<?php

class TransDataSource extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
     
     //  Insert new shortcode 
    public  function addTransData($id,$title ){
      $add_qry = "insert into transceivers (tranc_id,title) "
              . " values($id,'$title') " ;
       if ($this->connection->query($add_qry) === TRUE) {
            return true ;
      } else {
         General::writeEvent("addTransData-- error ".mysqli_error($this->connection));
            return false ;
      }
      $this->connection->close();
      }
       
      
      public  function getTransData(){
      $qry = "select * from transceivers " ;
      
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
      
       
      
       public  function getTransInfoByIdData($id){
      $qry = "select * from transceivers where id = $id " ;
      
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
      
       public function insertTransConnectionData($transId,$connectionId) {
   ///
        $isAdded = false;
        try {

            $stmt = $this->connection->prepare("insert into tranc_connections(tranc_id,connection_id) "
                    . " values(?,?) ");

            $stmt->bind_param("ii",$transId,$connectionId);
            $stmt->execute();

            if ($stmt->insert_id > 0) {
                $isAdded = true;
            } else {
                General::writeEvent("insertTransConnectionData error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("insertTransConnectionData error" . $e->getMessage());
        }

        return $isAdded;
    }
    
     public function getConnectionsByTransIdData($transId) {
         $table = array();
        try {
            $stmt = $this->connection->prepare("select tranc_connections.id, smpp_connections.id as connId,"
                    . "smpp_connections.title from tranc_connections,smpp_connections where "
                    . "tranc_connections.tranc_id= ? "
                    . "and tranc_connections.connection_id = smpp_connections.id  ");
            $stmt->bind_param("i",$transId);
             $stmt->execute();
            $result = $stmt->get_result();
           
            if ($result != null && $result->num_rows > 0) {
                $table =  mysqli_fetch_all($result,MYSQLI_ASSOC) ;
             }
             $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("getShortcodeConnectionsData error" . $e->getMessage());
        }
        return $table;
    }
    
    
    public function deleteConnectionData($id) {

        $isUpdated=false;
        try {

            $stmt = $this->connection->prepare("delete from tranc_connections where id = ?");

            $stmt->bind_param("i",$id);
            $stmt->execute();
            print_r($stmt);

            if ($stmt->affected_rows > 0) {
               $isUpdated = true ;
            } else {
                General::writeEvent("deleteConnectionData error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("deleteConnectionData error" . $e->getMessage());
        }

        return $isUpdated;
    }

      
      
       
    
}
