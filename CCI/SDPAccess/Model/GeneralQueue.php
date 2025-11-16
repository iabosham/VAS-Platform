<?php

class  GeneralQueue extends DBConnection {

    function __construct() {
        parent::__construct();
    }

    //  Insert new message_content 
    public function addMessageData($contentInfo) {

        $message_contentId = 0;
        try {
            $stmt = $this->connection->prepare("insert into message_queue_general (msisdn,message,send_time,conn_id,source_address) "
                    . " values(?,?,now(),?,?)")  ;
            print_r( $this->connection);
            $stmt->bind_param("ssis", $contentInfo['msisdn'], $contentInfo['message'] , $contentInfo['connId']
                    , $contentInfo['sourceAddress'] );

            $stmt->execute();
            if ($stmt->insert_id > 0) {
                $message_contentId = $stmt->insert_id;
            } else {
                General::addError($stmt->error);
                General::writeEvent("GeneralQueue addMessageData error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addContentMessage ... error" . $e->getContentMessage());
        }

        return $message_contentId;
    }
    
     
}
