<?php

class Inbox extends DBConnection {

    function __construct() {
        parent::__construct();
    }

    public function getInboxMessages($clientId, $fromDate, $toDate) {

        $where = "";

      
        if ($fromDate != null) {

            $where .= " and inbox.MSGTIME >= '$fromDate' ";
        }
        if ($toDate != null) {

            $where .= " and inbox.MSGTIME <= '$toDate' ";
        }
        $table = array();
        $stmt = $this->connection->prepare(" select distinct inbox.ID uID,inbox.*, smpp_connections.title as operatorName "
                . "from inbox,shortcode,vendor,smpp_connections where inbox.CONNECTIONID = smpp_connections.id and "
                . " inbox.SHORTCODESTR = shortcode.number and shortcode.company_id =smpp_connections.operator_id  "
                . "and shortcode.vendor_id in (select vendor_id from client where id = ? )  "
                . " $where "
                . "order by inbox.ID desc limit 200");
        $stmt->bind_param("i",$clientId);
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

    public function getInboxMessagesByShortcode($fromDate, $toDate, $isRead, $shortcode) {

        $where = "";

        if ($isRead > -1) {

            $where .= " and inbox.read_status = '$isRead' ";
        }

        if ($fromDate != null) {

            $where .= " and inbox.MSGTIME >= '$fromDate' ";
        }
        if ($toDate != null) {

            $where .= " and inbox.MSGTIME <= '$toDate' ";
        }

        $table = array();
        $ids = array();

        $stmt = $this->connection->prepare("select  inbox.ID, inbox.MSGTIME as messageTime,inbox.FROMMDN as fromNumber, inbox.SHORTMSG as MSG, inbox.SHORTCODESTR as shortcode, "
                . " inbox.read_status , operators.name as operatorName, operators.id as operatorId "
                . "from inbox,smpp_connections,operators "
                . "where inbox.SHORTCODESTR = ? and inbox.CONNECTIONID = smpp_connections.id and smpp_connections.operator_id = operators.id  $where "
                . "order by inbox.ID desc");

        $stmt->bind_param("s", $shortcode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($table, $row);
                array_push($ids, $row['ID']);
            }
        } else {
            General::writeEvent("getInboxMessagesByShortcode error" . mysqli_error($this->connection));
        }
        $this->connection->close();

        if ($ids != null) {

            $ids = implode(',', array_values($ids));

            print_r($ids);
            $inbox = new Inbox();
            $inbox->updateReadStatusData($shortcode, $ids);
        }

        return $table;
    }

    public function updateReadStatusData($shortCode, $ids) {

        $isUpdated = false;
        try {
            $stmt = $this->connection->prepare("update inbox set read_status = 1  "
                    . "  where read_status = 0 and SHORTCODESTR = ? AND id in(".$ids.") ") ;

            $stmt->bind_param("s", $shortCode );


            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $isUpdated = true;
            } else {
                General::addError($stmt->error);
                General::writeEvent("updateReadStatusData error" . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addContent ... error" . $e->getContent());
        }

        $this->connection->close();

        return $isUpdated;
    }

}
