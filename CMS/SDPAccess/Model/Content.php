<?php

class Content extends DBConnection {

    function __construct() {
        parent::__construct();
    }

    //  Insert new contents 
    public function addContentData($title,$status) {

        $contentsId = 0;
        try {
            $stmt = $this->connection->prepare("insert into contents (title,status) "
                    . " values(?,?)")
            ;

            $stmt->bind_param("si",$title,$status);

            $stmt->execute();
            if ($stmt->insert_id > 0) {
                $contentsId = $stmt->insert_id;
            } else {
                General::addError($stmt->error);
                General::writeEvent("addContent error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addContent ... error" . $e->getContent());
        }

        return $contentsId;
    }
    
     public function updateContentData($title,$status, $id) {

        $isUpdated = false ;
        try {
            $stmt = $this->connection->prepare("update contents set title=?,status=? "
                     . "  where id = ?")
            ;

            $stmt->bind_param("sii",$title,$status, $id);

            $stmt->execute();
            
             if ($stmt->affected_rows > 0  ) {
               $isUpdated = true ;
            } else {
              General::addError($stmt->error);
               General::writeEvent("updateContentData error" . $stmt->error);
            }
          
            $stmt->close();
             
            
        } catch (Exception $e) {
            General::writeEvent("addContent ... error" . $e->getContent());
        }

        return $isUpdated;
    }
    
    public function getContentsData() {
        $qry = "select contents.* , (select count(*) from sub_contents where content_id = contents.id ) as subCount from contents where status =1 ";

        $result = $this->connection->query($qry);

        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $table[] = $row;
                }
                return $table;
            } else {
                return null;
            }
            $this->connection->close();
        } else {
            General::writeEvent("getContentsData error " . mysqli_error($this->connection));
            $this->connection->close();
        }
    }
   
    public function getContentInfoByIdData($contentsId) {
        $qry = "select * from contents where id = $contentsId ";
        $row = null;
        $result = $this->connection->query($qry);
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
            }
        } else {
            General::writeEvent("getContentInfoByIdData error " . mysqli_error($this->connection));
        }
        $this->connection->close();
        return $row;
    }
    
    public  function getContentsByClientIdData($clientId){
          
      $table = array();
      $stmt = $this->connection->prepare("select distinct contents.id,contents.title from service_permission,sub_contents,contents,client "
              . "where  service_permission.sub_service_id=sub_contents.id and sub_contents.content_id = contents.id "
              . "and service_permission.provider_id = client.vendor_id and client.id = ?  ");
      
       $stmt->bind_param("i",$clientId);
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
  
    public function updateContentStatusData($contentsID, $status) {
        $update_qry = "update contents set status = $status where id = $contentsID  ";
        if ($this->connection->query($update_qry) === TRUE) {
            return true;
        } else {
            General::writeEvent("updateContentStatus error " . mysqli_error($this->connection));
            return false;
        }
        $this->connection->close();
    }
 
     public  function deleteContentData($contentsID){
           $rem_qry = "delete from contents where id = $contentsID " ;
           if ($this->connection->query($rem_qry) === TRUE) {
               return true ;
           } else {
               General::writeEvent("deleteContentData-- error ".mysqli_error($this->connection));
               return false ;
      }
      
      }
       
}
