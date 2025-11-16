<?php

class ContentMessage extends DBConnection {

    function __construct() {
        parent::__construct();
    }

    //  Insert new message_content 
    public function addContentMessageData($contentInfo) {

        $message_contentId = 0;
        try {
            $stmt = $this->connection->prepare("insert into message_content (msg,sub_service_id,serial_id,approval_flag,sending_date,client_id,user_id) "
                    . " values(?,?,?,?,?,?,?)")
            ;

            $stmt->bind_param("siiisii", $contentInfo['msg'], $contentInfo['subService'], $contentInfo['serial'], $contentInfo['approvalFlag']
                    , $contentInfo['sendingDate'], $contentInfo['clientId'], $contentInfo['userId']);

            $stmt->execute();
            if ($stmt->insert_id > 0) {
                $message_contentId = $stmt->insert_id;
            } else {
                General::addError($stmt->error);
                General::writeEvent("addContentMessage error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addContentMessage ... error" . $e->getContentMessage());
        }

        return $message_contentId;
    }
    
    

    public function updateApprovalStatusData($id,$status,$userId) {
     

        $isUpdated = false;
        try {
            $stmt = $this->connection->prepare("update message_content set approval_flag=?,user_id=?  "
                    . "  where id = ? and status != 1")
            ;

            $stmt->bind_param("iii", $status,$userId, $id);

            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $isUpdated = true;
            } else {
                General::addError($stmt->error);
                General::writeEvent("updateApprovalStatusData error" . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("updateApprovalStatusData ... error" . $e->getContentMessage());
        }

        return $isUpdated;
    }
    
    public function updateContentStatusData($id,$status,$userId) {
     

        $isUpdated = false;
        try {
            $stmt = $this->connection->prepare("update message_content set status=?,user_id=?  "
                    . "  where id = ? and status != 1")  ;

            $stmt->bind_param("iii", $status,$userId, $id);

            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $isUpdated = true;
            } else {
                General::addError($stmt->error);
                General::writeEvent("updateContentStatusData error" . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("updateContentStatusData ... error" . $e->getContentMessage());
        }

        return $isUpdated;
    }
    
    public function updateContentMessageData($msg, $orderId,$sendDate,$userId, $id,$status = 0) {
        
        $extra = "" ;
        
        if($userId > 0){
            
            $extra.= " ,user_id = $userId ";
            
        }

        $isUpdated = false;
	//echo $msg;
        try {
            $stmt = $this->connection->prepare("update message_content set msg=?,serial_id=? ,sending_date=?,status=? $extra "
                    . "  where id = ?");

            $stmt->bind_param("sisii", $msg, $orderId,$sendDate, $status , $id);
            //print_r($stmt);

            $stmt->execute();

   		//print_r($this->connection);
            if ($stmt->affected_rows > 0) {
                $isUpdated = true;
            } else {
                General::addError($stmt->error);
                General::writeEvent("updateContentMessageData error");
            }

            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addContentMessage ... error" . $e->getContentMessage());
        }

        return $isUpdated;
    }

    public function getContentMessagesByClientIdData($from,$to, $clientId) {

        $table = array();
          $where = "" ;
          
         if($from !=null){  $where.= " and message_content.sending_date >= '$from'"  ;  }
         if($to !=null){  $where.= " and message_content.sending_date <= '$to'"  ;  }
         

        $qry = "select message_content.id,message_content.sending_date,message_content.status,message_content.serial_id,message_content.msg "
                . ",message_content.approval_flag,message_content.status_date,sub_contents.title as subContentTitle,contents.title as contentTitle "
                . " from message_content,sub_contents,contents "
                . "where message_content.sub_service_id = sub_contents.id and sub_contents.content_id=contents.id and client_id = ? $where ";

        $stmt = $this->connection->prepare($qry);
         
        $stmt->bind_param("i", $clientId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($table, $row);
            }
        } else {
            General::writeEvent("getClientsByVendorIdData error" . mysqli_error($this->connection));
        }
        $this->connection->close();
        return $table;
    }
    
     public function getContentMessagesData($from,$to,$serviceId,$subServiceId,$approveFlag,$contentStaus) {
         
         $where = "" ;
         if($from !=null){  $where.= " and message_content.sending_date >= '$from'"  ;  }
         if($to !=null){  $where.= " and message_content.sending_date <= '$to'"  ;  }
         if($serviceId > 0 ){  $where.= " and contents.id = ".$serviceId  ;  }
         if($subServiceId > 0 ){  $where.= " and sub_contents.id = ".$subServiceId  ;  }
         if($approveFlag > -1){  $where.= " and message_content.approval_flag = ".$approveFlag  ;  }
         if($contentStaus > -1){  $where.= " and message_content.status = ".$contentStaus  ;  }
         

        $table = array();

        $qry = "select message_content.id,message_content.sending_date,message_content.status,message_content.serial_id,message_content.msg "
                . ",message_content.approval_flag,message_content.status_date,sub_contents.title as subContentTitle,contents.title as contentTitle "
                . " from message_content,sub_contents,contents "
                . "where message_content.sub_service_id = sub_contents.id and sub_contents.content_id=contents.id $where  order by message_content.id desc";

        $stmt = $this->connection->prepare($qry);
        
         
       // $stmt->bind_param("i", $clientId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($table, $row);
            }
        } else {
            General::writeEvent("getContentMessagesData error" . mysqli_error($this->connection));
        }
        $this->connection->close();
        return $table;
    }

    public function getContentMessageInfoByIdData($message_contentId) {
        $qry = "select message_content.*,sub_contents.title as subTitle,contents.title as serviceTitle,sub_contents.msg_per_day "
                . "from message_content,sub_contents,contents where message_content.id = $message_contentId "
                . "and message_content.sub_service_id=sub_contents.id and sub_contents.content_id=contents.id ";
        $row = null;
        $result = $this->connection->query($qry);
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
            }
        } else {
            General::writeEvent("getContentMessageInfoByIdData error " . mysqli_error($this->connection));
        }
        $this->connection->close();
        return $row;
    }
    
     public function getInfoByDateAndOrderData($serviceId,$order,$date) {

        try {
            $stmt = $this->connection->prepare("select * from message_content "
                    . "where sub_service_id= ? and serial_id= ? and sending_date =? ");
            
            $stmt->bind_param("iis",$serviceId,$order,$date);
            
            print_r($stmt);

            $stmt->execute();
            $result = $stmt->get_result();
            
            $row = null;
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
             }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("getInfoByMessageAndOrderData" . $e->getMessage());
        }
        
        $this->connection->close();
        return $row;
    }
     

    public function updateContentMessageStatusData($message_contentID, $status) {
        $update_qry = "update message_content set status = $status where id = $message_contentID  ";
        if ($this->connection->query($update_qry) === TRUE) {
            return true;
        } else {
            General::writeEvent("updateContentMessageStatus error " . mysqli_error($this->connection));
            return false;
        }
        $this->connection->close();
    }

    public function deleteContentMessageData($message_contentID) {
        $rem_qry = "delete from message_content where id = $message_contentID ";
        if ($this->connection->query($rem_qry) === TRUE) {
            return true;
        } else {
            General::writeEvent("deleteContentMessageData-- error " . mysqli_error($this->connection));
            return false;
        }
    }

}
