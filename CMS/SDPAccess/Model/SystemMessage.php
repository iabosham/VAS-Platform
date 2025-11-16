<?php

class SystemMessage extends DBConnection {

    function __construct() {
        parent::__construct();
    }

    public function addSystemMessageData($message, $code, $desc) {
        $id = 0;
        try {
            $stmt = $this->connection->prepare("insert into system_message(message,code,description) "
                    . " values(?,?,?)");

            $stmt->bind_param("sis", $message, $code, $desc);
            $stmt->execute();
            if ($stmt->insert_id > 0) {
                $id = $stmt->insert_id;
            } else {
                General::addError($stmt->error);
                General::writeEvent("addSystemMessageData error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addSystemMessageData error" . $e->getMessage());
        }

        return $id;
    }
    
    public function updateSystemMessageData($id,$message, $code, $desc) {
        $flage = false;
        try {
            $stmt = $this->connection->prepare("update system_message set message = ? , code = ?, description= ? where id = ? ");

            $stmt->bind_param("sisi", $message, $code, $desc,$id);
            $stmt->execute();
            
             if($stmt->errno == 0 && $stmt->affected_rows > 0){
                $flage = true;
              } else {
                 General::writeEvent("updateSystemMessageData error" . $stmt->error);
            }
            
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("updateSystemMessageData error" . $e->getMessage());
        }

        return $id;
    }

    public function getSystemMessagesData() {
        $qry = "select * from system_message ";

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

    public function getShortcodeInfoByNumberData($number) {
        $qry = "select * from shortcode  "
                . "where shortcode.number = $number ";

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

    public function getSystemMessageByCodeData($code) {

        $row = null;
        $qry = "select * from system_message where code = $code ";

        $result = $this->connection->query($qry);

        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
        }

        return $row;
    }

}
