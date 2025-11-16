<?php

class SMPPConnectionDataSource extends DBConnection  {

    public function insertShortcodeConnectionData($shortcodeId,$connectionId) {
   ///
        $isAdded = false;
        try {

            $stmt = $this->connection->prepare("insert into shortcode_connections(shortcode_id,connection_id) "
                    . " values(?,?) ");

            $stmt->bind_param("ii",$shortcodeId,$connectionId);
            $stmt->execute();

            if ($stmt->insert_id > 0) {
                $isAdded = true;
            } else {
                General::writeEvent("insertShortcodeConnectionData error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("insertShortcodeConnectionData error" . $e->getMessage());
        }

        return $isAdded;
    }

    public function getSMPPConnectionsData() {
         $table = array();
        try {
            $stmt = $this->connection->prepare("select * from smpp_connections ");
              $stmt->execute();
            $result = $stmt->get_result();
           
            if ($result != null && $result->num_rows > 0) {
                $table =  mysqli_fetch_all($result,MYSQLI_ASSOC) ;
             }
             $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("getSMPPConnectionsData error" . $e->getMessage());
        }
        return $table;
    }
    
     public function getSMPPConnectionsByCompanyIdData($companyId) {
         $table = array();
        try {
            $stmt = $this->connection->prepare("select * from smpp_connections where operator_id = $companyId ");
              $stmt->execute();
            $result = $stmt->get_result();
           
            if ($result != null && $result->num_rows > 0) {
                $table =  mysqli_fetch_all($result,MYSQLI_ASSOC) ;
             }
             $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("getSMPPConnectionsData error" . $e->getMessage());
        }
        return $table;
    }
    
     public function deleteConnectionData($id) {

        $isUpdated=false;
        try {

            $stmt = $this->connection->prepare("delete from smpp_connections where id = ?");

            $stmt->bind_param("i",$id);
            $stmt->execute();
            print_r($stmt);

            if ($stmt->affected_rows > 0) {
               $isUpdated = true ;
            } else {
                General::writeEvent("deleteGroupActionByIdData error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("deleteGroupActionByIdData error" . $e->getMessage());
        }

        return $isUpdated;
    }
    
    
}
