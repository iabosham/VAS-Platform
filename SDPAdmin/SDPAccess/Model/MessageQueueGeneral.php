<?php

class MessageQueueGeneral extends DBConnection {

    function __construct() {
        parent::__construct();
    }
    
     public function addMessageData($msisdn, $msg,$connId,$sourceAddress,$clientId = 0, $service_id = 0, $msgType = 0) {

        $messageId = 0;
        try {
            $stmt = $this->connection->prepare("insert into message_queue_general(msisdn,message,send_time,conn_id,source_address,client_id,service_id,msg_type) "
                    . " values(?,?,now(),?,?,?,?,?)") ;

            $stmt->bind_param("ssisiii", $msisdn, $msg, $connId, $sourceAddress,$clientId,$service_id,$msgType);

            $stmt->execute();
            if ($stmt->insert_id > 0) {
                $messageId = $stmt->insert_id;
            } else {
                General::addError($stmt->error);
                General::writeEvent("addMessage general error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addMessage general ... error" . $e->getMessage());
        }

        $this->connection->close();
        
        return $messageId;
    }
    
      public function getMessageQueueInfoData($messageId) {

        try {
            $stmt = $this->connection->prepare("select * from message_queue_general "
                    . "where id = ? ");
            $stmt->bind_param("i", $messageId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = null;
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("getMessageQueueInfoData" . $e->getMessage());
        }

        $this->connection->close();
        return $row;
    }
 
 
}
