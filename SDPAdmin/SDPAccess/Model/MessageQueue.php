<?php

class MessageQueue extends DBConnection {

    function __construct() {
        parent::__construct();
    }

    //  Insert new message_queue 
    public function addMessageQueueData($messageID, $subscriberID) {
        $add_qry = "insert into message_queue(message_id,subscriber_id) "
                . " values('$messageID','$subscriberID') ";
        if ($this->connection->query($add_qry) === TRUE) {
            return true;
        } else {
            General::writeEvent("addMessageQueue-- error " . mysqli_error($this->connection));
            return false;
        }
        $this->connection->close();
    }

    public function getMessageQueuesData() {
        $qry = "select message_queue.id as messageQueueId, message.id as messageID,message.msg,subscriber.id as subscriberID,"
                . "subscriber.msisdn,shortcode.number "
                . "from message_queue,message,subscriber,service,shortcode "
                . "where message_queue.subscriber_id=subscriber.id and "
                . "message_queue.message_id=message.id and message.service_id=service.id and "
                . "service.shortcode_id=shortcode.id limit 500 ";

        $result = $this->connection->query($qry);

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
    }

    public function getQueueMessageCountsData($fromDate,$toDate,$companyId) {
        
        $where = "";
        
        if($companyId > 0 ){
            
            $where.= " and shortcode.company_id = $companyId " ;
        }
           if($fromDate != null){
            
            $where.= " and message_queue.send_time >= unix_timestamp('$fromDate') " ;
        }
        
           if($toDate != null){
            
            $where.= " and message_queue.send_time <= unix_timestamp('$toDate') " ;
        }
        

        $qry = "select count(*) as counts,service.name as serviceName,shortcode.title as mainServiceName,shortcode.number shortcodeNumber"
                . ",operators.name as operatorName,country.name as countryName "
                . "from message_queue,message,service,shortcode,operators, country "
                . "where message_queue.message_id=message.id and message.service_id=service.id "
                . "and service.shortcode_id=shortcode.id and shortcode.company_id=operators.id and operators.country_id=country.id $where "
                . " group by serviceName order by counts desc";

        $result = $this->connection->query($qry);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $table[] = $row;
            }
            return $table;
        } else {
            return null;
        }
         
    }

    public function getMessageQueueInfoByNumberData($number) {
        $qry = "select * from message_queue  "
                . "where message_queue.number = $number ";

        $result = $this->connection->query($qry);

        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
        $this->connection->close();
    }

    //  delete new message_queue 
    public function deleteMessageQueueData($messageID) {
        $add_qry = "delete from message_queue where id = $messageID ";
        if ($this->connection->query($add_qry) === TRUE) {
            return true;
        } else {
            General::writeEvent("removeMessageQueueData error " . mysqli_error($this->connection));
            return false;
        }
        $this->connection->close();
    }

    public function getMessageQueueCountsByMessageIdData($messageId) {
        $qry = "select  resend_count,count(*) as counts "
                . " from message_queue where message_id = $messageId group by resend_count ";

        $result = $this->connection->query($qry);

        $table = array();
        if ($result != null && $result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($table, $row);
            }
        }
        $this->connection->close();
        return $table;
    }

    public function getQueueMessages($fromDate, $toDate, $serviceId) {

        $where = "";

        if ($serviceId > 0) {

            $where .= " and service.SHORTCODESTR = '$shortcodeId' ";
        }

        if ($companyId > 0) {

            $where .= " and shortcode.company_id = $companyId ";
        }
        if ($fromDate != null) {

            $where .= " and inbox.MSGTIME >= '$fromDate' ";
        }
        if ($toDate != null) {

            $where .= " and inbox.MSGTIME <= '$toDate' ";
        }
        $table = array();
        $stmt = $this->connection->prepare(" select inbox.*, smpp_connections.title as operatorName from inbox,smpp_connections where inbox.CONNECTIONID = smpp_connections.id $where "
                . "order by inbox.ID desc");
        // $stmt->bind_param("i",$vendorId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($table, $row);
            }
        } else {
            General::writeEvent("getInboxMessages error" . mysqli_error($this->connection));
        }

        return $table;
    }

}
