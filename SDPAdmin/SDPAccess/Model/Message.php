<?php

class Message extends DBConnection {

    function __construct() {
        parent::__construct();
    }

    //  Insert new message 
    public function addMessageData($msg, $serviceID, $sendTime, $clientID, $isApproved, $orderId) {

        $messageId = 0;
        try {
            $stmt = $this->connection->prepare("insert into message (msg,service_id,sendTime,client_id,is_approved,send_time_number,order_id) "
                    . " values(?,?,?,?,?,UNIX_TIMESTAMP(sendTime),?)")
            ;

            $stmt->bind_param("sisiii", $msg, $serviceID, $sendTime, $clientID, $isApproved, $orderId);

            $stmt->execute();
            if ($stmt->insert_id > 0) {
                $messageId = $stmt->insert_id;
            } else {
                General::addError($stmt->error);
                General::writeEvent("addMessage error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addMessage ... error" . $e->getMessage());
        }

        return $messageId;
    }

    public function updateMessageData($msg, $serviceID, $sendTime, $clientID, $id) {

        $isUpdated = false;
        try {
            $stmt = $this->connection->prepare("update message set msg=?,service_id=? "
                    . ",sendTime=?,client_id=?,send_time_number=UNIX_TIMESTAMP('$sendTime') "
                    . "  where id = ?")
            ;

            $stmt->bind_param("sisii", $msg, $serviceID, $sendTime, $clientID, $id);

            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $isUpdated = true;
            } else {
                General::addError($stmt->error);
                General::writeEvent("updateMessageData error" . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addMessage ... error" . $e->getMessage());
        }

        return $isUpdated;
    }

    public function getUnsentMessagesData() {
        $qry = "select * from message where status = 0 and is_approved = 1 and sendTime between NOW() - INTERVAL 10 MINUTE and NOW()  ";

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
            General::writeEvent("getMessagesData error " . mysqli_error($this->connection));
            $this->connection->close();
        }
    }

    public function getMessagesByVendorData($vendorID, $fromDate, $toDate) {

        $qry = "select message.id,message.msg,message.status,message.sendTime,message.creationDate,"
                . "message.is_approved,client.name as clientName,service.name as serviceName,"
                . "service.id as serviceId,"
                . "(select count(*) from service_subscription where service_subscription.service_id = service.id) as subscribersCount "
                . " from message,client,service,vendor "
                . "where message.client_id=client.id and client.vendor_id = vendor.id and vendor.id = $vendorID and message.service_id=service.id "
                . "and message.sendTime >= '$fromDate' and message.sendTime <= '$toDate' order by message.id desc ";


        $table = null;
        $result = $this->connection->query($qry);
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $table[] = $row;
                }
            }
        } else {
            General::writeEvent("getMessagesByVendorData error " . mysqli_error($this->connection));
        }
        $this->connection->close();
        return $table;
    }

    public function getMessagesData($serviceID, $fromDate, $toDate,$companyId) {

        $where = "";

        if ($serviceID > 0) {

            $where .= " and service.id = $serviceID ";
        }
        
        if ($companyId > 0) {

            $where .= " and shortcode.company_id = $companyId ";
        }

        if ($fromDate != null) {
            $where .= " and message.sendTime >= '$fromDate' ";
        }

        if ($toDate != null) {
            $where .= " and message.sendTime <= '$toDate' ";
        }

        $qry = "select message.id,message.msg,message.status,message.sendTime,message.creationDate,"
                . "message.is_approved ,service.name as serviceName,shortcode.number,"
                . "service.id as serviceId, LENGTH(msg) as msgLen,operators.name as operatorName "
                . " from message,service,shortcode,operators "
                . "where message.service_id=service.id and service.shortcode_id=shortcode.id "
                . "and shortcode.company_id= operators.id  $where  "
                . "order by message.id desc ";


        $table = null;
        $result = $this->connection->query($qry);
        
        
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $table[] = $row;
                }
            }
        } else {
            General::writeEvent("getMessagesData error " . mysqli_error($this->connection));
        }
        $this->connection->close();
        return $table;
    }
    
    public function getUnpushedMessagesData($serviceID, $fromDate, $toDate,$companyId) {

        $where = "";
        $where1 = "";

        if ($serviceID > 0) {

            $where1.= " and service.id = $serviceID ";
        }
        
        if ($companyId > 0) {

            $where1.= " and shortcode.company_id = $companyId ";
        }


        if ($fromDate != null) {
            $where .= " and message.sendTime >= '$fromDate' ";
        }

        if ($toDate != null) {
            $where .= " and message.sendTime <= '$toDate' ";
        }

        $qry = "select service.id, service.name as serviceName,shortcode.number,shortcode.title,"
                . "service.id as serviceId,operators.name as operatorName "
                . " from service,shortcode,operators  "
                . "where service.isActive = 1 and service.service_method =1 and "
                . "service.id not in (select service_id from message where service_id = service.id  $where ) "
                . "and service.shortcode_id=shortcode.id and shortcode.company_id = operators.id  $where1   "
                . "  order by service.id   ";
 
        $table = null;
        $result = $this->connection->query($qry);
         
        
        
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $table[] = $row;
                }
            }
        } else {
            General::writeEvent("getUnpushedMessagesData error " . mysqli_error($this->connection));
        }
        $this->connection->close();
        return $table;
    }

    public function getMessagesByVendorServiceCodeData($vendorID, $fromDate, $toDate, $serviceCode) {

        $qry = "select message.id,message.msg,message.status,message.sendTime,message.creationDate,"
                . "message.is_approved,client.name as clientName,service.name as serviceName,"
                . "(select count(*) from service_subscription where service_subscription.service_id = service.id) as subscribersCount "
                . " from message,client,service,vendor "
                . "where message.client_id=client.id and client.vendor_id = vendor.id and vendor.id = $vendorID and message.service_id=service.id "
                . " and service.service_code = $serviceCode and message.creationDate between '$fromDate' and '$toDate'  order by message.id desc ";


        $table = null;
        $result = $this->connection->query($qry);
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $table[] = $row;
                }
            }
        } else {
            General::writeEvent("getMessagesByVendorServiceCodeData error " . mysqli_error($this->connection));
        }
        $this->connection->close();
        return $table;
    }

    public function getUnapprovedMessagesByVendorData($vendorID, $fromDate, $toDate) {
        $qry = "select message.id,message.msg,message.status,message.sendTime,message.creationDate,"
                . "message.is_approved,client.name as clientName,service.name as serviceName,"
                . "(select count(*) from service_subscription where service_subscription.service_id = service.id) as subscribersCount "
                . " from message,client,service,vendor "
                . "where message.is_approved = 0 and message.client_id=client.id and client.vendor_id = vendor.id and vendor.id = $vendorID and message.service_id=service.id "
                . "and message.creationDate between '$fromDate' and '$toDate' order by message.id desc ";
        $table = null;
        $result = $this->connection->query($qry);
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $table[] = $row;
                }
            }
        } else {
            General::writeEvent("getUnapprovedMessagesByVendorData error " . mysqli_error($this->connection));
        }
        $this->connection->close();
        return $table;
    }

    public function getMessageInfoByIdData($messageId) {
        $qry = "select message.id,message.msg,message.status,message.sendTime,message.creationDate,"
                . "UNIX_TIMESTAMP(date(message.sendTime)) as table_number ,client.name as clientName,service.name as serviceName,"
                . "shortcode.number as shortcode,vendor.name as venderName "
                . " from message,client,service,shortcode,vendor "
                . "where message.id= $messageId and  message.client_id=client.id "
                . "and client.vendor_id = vendor.id "
                . "and message.service_id=service.id "
                . "and service.shortcode_id=shortcode.id   ";
        $row = null;
        $result = $this->connection->query($qry);
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
            }
        } else {
            General::writeEvent("getMessageInfoByIdData error " . mysqli_error($this->connection));
        }
        $this->connection->close();
        return $row;
    }

    public function checkIsMessageExistByDateData($message, $date, $serviceId) {

        try {
            $stmt = $this->connection->prepare("select * from message "
                    . "where msg = ? and date(sendTime) = date(?) and service_id = ? ");
            $stmt->bind_param("ssi", $message, $date, $serviceId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = null;
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("checkIsMessageExistByDateData" . $e->getMessage());
        }

        $this->connection->close();
        return $row;
    }

    public function getMaxOrderIdOfMessageData($serviceId) {

        try {
            $stmt = $this->connection->prepare("select max(order_id) as orderId from message "
                    . "where service_id = ? ");
            $stmt->bind_param("i", $serviceId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = null;
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("getMaxOrderIdOfMessageData" . $e->getMessage());
        }

        $this->connection->close();
        return $row;
    }

    public function updateMessageStatusData($messageID, $status) {
        $update_qry = "update message set status = $status where id = $messageID  ";
        if ($this->connection->query($update_qry) === TRUE) {
            return true;
        } else {
            General::writeEvent("updateMessageStatus error " . mysqli_error($this->connection));
            return false;
        }
        $this->connection->close();
    }
    
     public function updateTextAndStatusData($messageID, $status,$msg) {
        $update_qry = "update message set status = $status,msg = '$msg' where id = $messageID  ";
        if ($this->connection->query($update_qry) === TRUE) {
            return true;
        } else {
            General::writeEvent("updateTextAndStatusData error " . mysqli_error($this->connection));
            return false;
        }
        $this->connection->close();
    }

    public function updateApprovalStatusData($messageID, $approvalFlag) {
        $update_qry = "update message set is_approved = $approvalFlag where id = $messageID  ";
        if ($this->connection->query($update_qry) === TRUE) {
            return true;
        } else {
            General::writeEvent("updateApprovalStatus error " . mysqli_error($this->connection));
            return false;
        }
        $this->connection->close();
    }

    public function deleteMessageData($messageID) {
        $rem_qry = "delete from message where id = $messageID ";
        if ($this->connection->query($rem_qry) === TRUE) {
            return true;
        } else {
            General::writeEvent("deleteMessageData-- error " . mysqli_error($this->connection));
            return false;
        }
    }

    public function getSubscriberMessagesData($msisdn, $vendorId, $serviceId) {
        $table = array();
        $where = "";

        if ($serviceId > 0) {

            $where .= " and message.service_id = $serviceId ";
        }

        try {

            //UNIX_TIMESTAMP(DATE_ADD(date(message.sendTime), INTERVAL 3 HOUR))
            $stmt = $this->connection->prepare("SELECT message.id,message.msg,message.status,message.sendTime,"
                    . " message.creationDate,service.name as serviceName,UNIX_TIMESTAMP(date(message.sendTime)) as table_number FROM "
                    . "message,service,shortcode,vendor,service_subscription,subscriber "
                    . "WHERE  subscriber.msisdn = ? and message.status = 1 and vendor.id = ? $where  and message.service_id=service_subscription.service_id "
                    . "and service_subscription.subscriber_id =subscriber.id  "
                    . "and message.sendTime > service_subscription.subscription_date and message.service_id = service.id "
                    . "and service.shortcode_id =shortcode.id and shortcode.vendor_id =vendor.id order by message.id desc limit 10 ");

            $stmt->bind_param("ii", $msisdn, $vendorId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result != null && $result->num_rows > 0) {
                $table = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
            // print_r($table);
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("getSubscriberMessagesData error" . $e->getMessage());
        }
        return $table;
    }

}
