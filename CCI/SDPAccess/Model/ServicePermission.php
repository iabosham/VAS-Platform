<?php

class ServicePermission extends DBConnection {

    function __construct() {
        parent::__construct();
    }

    //  Insert new service_permission 
    public function addServicePermissionData($subServiceId,$providerId) {

        $service_permissionId = 0;
        try {
            $stmt = $this->connection->prepare("insert into service_permission (sub_service_id,provider_id) "
                    . " values(?,?)")
            ;

            $stmt->bind_param("ii",$subServiceId,$providerId);

            $stmt->execute();
            if ($stmt->insert_id > 0) {
                $service_permissionId = $stmt->insert_id;
            } else {
                General::addError($stmt->error);
                General::writeEvent("addServicePermission error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addServicePermission ... error" . $e->getServicePermission());
        }

        return $service_permissionId;
    }
  
    public function getLastServicePermissionsData() {
        $qry = "select service_permission.id,vendor.name,sub_contents.title   from service_permission,sub_contents,vendor where service_permission.sub_service_id = sub_contents.id"
                . " and  service_permission.provider_id =vendor.id  order by service_permission.id desc limit 10 ";

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
            
        } else {
            General::writeEvent("getServicePermissionsData error " . mysqli_error($this->connection));
           
        }
    }
   
    public function getServicePermissionInfoData($subServiceId,$providerId) {
        $qry = "select * from service_permission where sub_service_id = $subServiceId and provider_id = $providerId ";
        $row = null;
        $result = $this->connection->query($qry);
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
            }
        } else {
            General::writeEvent("getServicePermissionInfoData error " . mysqli_error($this->connection));
        }
         
        return $row;
    }
    
        public function getServicePermissionsByProviderIdData($providerId) {
        
        $where = "" ;
        
        if($providerId > 0) {
           $where.= " and provider_id = $providerId " ; 
        }
        
         $qry = "select service_permission.id,vendor.name,sub_contents.title   from service_permission,sub_contents,vendor "
                 . "where service_permission.sub_service_id = sub_contents.id $where "
                . " and  service_permission.provider_id =vendor.id   order by service_permission.id desc limit 10 ";


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
           
        } else {
            General::writeEvent("getServicePermissionsByProviderIdData error " . mysqli_error($this->connection));
         }
    }
 
 
     public  function deleteServicePermissionData($servicePermissionID){
           $rem_qry = "delete from service_permission where id = $servicePermissionID " ;
           if ($this->connection->query($rem_qry) === TRUE) {
               return true ;
           } else {
               General::writeEvent("deleteServicePermissionData-- error ".mysqli_error($this->connection));
               return false ;
      }
      
      }
       
}
