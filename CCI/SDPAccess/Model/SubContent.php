<?php

class SubContent extends DBConnection {

    function __construct() {
        parent::__construct();
    }

    //  Insert new sub_contents 
    public function addSubContentData($title,$status,$contentTypeId,$msgCount,$contentLength,$approveFlag,$desc,$contentId) {

        $sub_contentsId = 0;
        try {
            $stmt = $this->connection->prepare("insert into sub_contents "
                    . "(title,status,content_type,msg_per_day,content_length,need_approval,description,content_id) "
                    . " values(?,?,?,?,?,?,?,?)") ;

            $stmt->bind_param("siiiiisi",$title,$status,$contentTypeId,$msgCount,$contentLength,$approveFlag,$desc,$contentId);

            $stmt->execute();
            if ($stmt->insert_id > 0) {
                $sub_contentsId = $stmt->insert_id;
            } else {
                General::addError($stmt->error);
                General::writeEvent("addSubContent error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addSubContent ... error" . $e->getSubContent());
        }

        return $sub_contentsId;
    }
    
     public function updateSubContentData($title,$status,$contentTypeId,$msgCount,$contentLength,$approveFlag,$desc,$contentId, $id) {

        $isUpdated = false ;
        try {
            $stmt = $this->connection->prepare("update sub_contents set title=?,status=?,content_type=?,msg_per_day=?,content_length=?,need_approval=?,description=?,content_id=? "
                     . "  where id = ?")
            ;

            $stmt->bind_param("siiiiisii",$title,$status,$contentTypeId,$msgCount,$contentLength,$approveFlag,$desc,$contentId, $id);

            $stmt->execute();
            
             if ($stmt->affected_rows > 0 || $stmt->affected_rows == 0  ) {
               $isUpdated = true ;
            } else {
              General::addError($stmt->error);
               General::writeEvent("updateSubContentData error" . $stmt->error);
            }
          
            $stmt->close();
             
            
        } catch (Exception $e) {
            General::writeEvent("addSubContent ... error" . $e->getSubContent());
        }

        return $isUpdated;
    }
    
    public function getSubContentsData($contentId) {
        
        $where = "" ;
        
        if($contentId > 0) {
           $where.= " and content_id = $contentId " ; 
        }
        
        $qry = "select sub_contents.*,contents.title as contentTitle from sub_contents,contents"
                . " where sub_contents.content_id =contents.id $where order by id desc ";

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
            General::writeEvent("getSubContentsData error " . mysqli_error($this->connection));
            $this->connection->close();
        }
    }
   
    public function getSubContentInfoByIdData($sub_contentsId) {
        $qry = "select * from sub_contents where id = $sub_contentsId ";
        $row = null;
        $result = $this->connection->query($qry);
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
            }
        } else {
            General::writeEvent("getSubContentInfoByIdData error " . mysqli_error($this->connection));
        }
        $this->connection->close();
        return $row;
    }
 
 
     public  function deleteSubContentData($sub_contentsID){
           $rem_qry = "delete from sub_contents where id = $sub_contentsID " ;
           if ($this->connection->query($rem_qry) === TRUE) {
               return true ;
           } else {
               General::writeEvent("deleteSubContentData-- error ".mysqli_error($this->connection));
               return false ;
      }
      
      }
       
}
