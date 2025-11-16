<?php

class Service extends DBConnection {

    function __construct() {
        parent::__construct();
    }

    public function addServiceData($name, $serviceType, $serviceKey, $shortcodeID, $userID, $subMessage,
            $unSubMessage, $senderName, $freeSource, $method, $subServiceId, $systemId,
            $senderInfo, $type,$serviceCode,$unSubKey) {

        $serviceId = 0;

        try {
            $stmt = $this->connection->prepare("insert into service (name,service_type_id,service_key,shortcode_id,"
                    . "user_id,sub_message,unsub_message,sender_name,"
                    . "free_source,service_method,sub_service_id,system_id,sender_info,type,service_code,unsub_key)"
                    . " values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            print_r($this->connection);

            $stmt->bind_param("sisiissssiississ", $name, $serviceType, $serviceKey, $shortcodeID,
                    $userID, $subMessage, $unSubMessage, $senderName, $freeSource, $method,
                    $subServiceId, $systemId, $senderInfo, $type,$serviceCode,$unSubKey);
            $stmt->execute();

            if ($stmt->insert_id > 0) {
                $serviceId = $stmt->insert_id;
            } else {
                General::writeEvent(" addServiceData erorr: " . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addServiceData error" . $e->getMessage());
        }

        return $serviceId;
    }

    public function addKeyData($key, $serviceId, $type) {
        $keyId = 0;
        try {
            $stmt = $this->connection->prepare("insert into service_keys(service_key,service_id,key_type)"
                    . " values(?,?,?)");

            $stmt->bind_param("sii", $key, $serviceId, $type);
            $stmt->execute();

            if ($stmt->insert_id > 0) {
                $keyId = $stmt->insert_id;
            } else {
                General::writeEvent("addKey error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("addKey error" . $e->getMessage());
        }

        return $keyId;
    }

    public function deleteServiceKeyByIdData($groupId) {

        $isUpdated = false;
        try {

            $stmt = $this->connection->prepare("delete from service_keys where id = ? and key_type = 0 ");

            $stmt->bind_param("i", $groupId);
            $stmt->execute();
            print_r($stmt);

            if ($stmt->affected_rows > 0) {
                $isUpdated = true;
            } else {
                General::writeEvent("deleteServiceKeyByIdData error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("deleteServiceKeyByIdData error" . $e->getMessage());
        }

        return $isUpdated;
    }

    public function getkeysByServiceIdData($serviceId) {
        $table = array();
        try {
            $stmt = $this->connection->prepare("select * from service_keys where service_id = ? "
                    . "order by id ");
            //print_r($this->connection);
            $stmt->bind_param("i", $serviceId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result != null && $result->num_rows > 0) {
                $table = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("getkeysByServiceIdData error" . $e->getMessage());
        }
        return $table;
    }

    public function updateServiceData($id, $name, $serviceType, $serviceKey, $shortcodeID, $userID
            , $subMessage, $unSubMessage, $senderName, $freeSource, $method, $unSub, $contentId, 
            $senderInfo,$systemId,$type,$serviceCode) {
        
        $update_qry = "update service set name = '$name',service_type_id=$serviceType,service_key='$serviceKey',"
                . " shortcode_id= $shortcodeID,user_id =$userID,sub_message='$subMessage',unsub_message='$unSubMessage'"
                . ",sender_name='$senderName',free_source='$freeSource',service_method='$method' ,unsub_key='$unSub' ,sub_service_id='$contentId' "
                . ",sender_info='$senderInfo',system_id='$systemId',type='$type',service_code = '$serviceCode' "
                . "where id =  $id ";
        $isUpdated = $this->connection->query($update_qry);

        if ($isUpdated == TRUE) {
            return true;
        } else {
            General::writeEvent("updateServiceData error " . mysqli_error($this->connection));
            return false;
        }
    }

    public function updateServiceKeyData($keyId, $serviceKey) {

        $isUpdated = false;
        try {

            $stmt = $this->connection->prepare("update service_keys set service_key = ? where id = ? ");
            $stmt->bind_param("si", $serviceKey, $keyId);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $isUpdated = true;
            } else {
                General::writeEvent("updateServiceKeyData error" . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("updateServiceKeyData error" . $e->getMessage());
        }

        return $isUpdated;
    }

    public function getServicesData($shortcodeId, $companyId) {
        $where = "";
        if ($shortcodeId > 0) {

            $where .= " and shortcode.id = $shortcodeId ";
        }

        if ($companyId > 0) {

            $where .= " and shortcode.company_id = $companyId ";
        }
        $qry = "select service.id,service.name as serviceName,service.service_code,service.service_key,service.sender_name,"
                . "vendor.name as vendorName,operators.name as companyName,"
                . "shortcode.number,service_type.name as serviceTypeName,shortcode.title as mainServiceName "
                . "from service,service_type,shortcode,vendor,operators "
                . "where service.shortcode_id=shortcode.id and shortcode.company_id=operators.id and "
                . "operators.status = 1 and shortcode.vendor_id=vendor.id "
                . "and service.service_type_id = service_type.id $where ";
                
               // print_r($qry);

        $result = $this->connection->query($qry);
        $table = null;
        if ($result != null) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $table[] = $row;
                }
            }
        } else {
            General::writeEvent("getServicesByClientIDData error " . mysqli_error($this->connection));
        }
        return $table;
    }

    public function getServicesByTypeData($type) {
        $qry = "select service.id,service.name as serviceName,service.service_code,service.en_name as enServiceName, service.service_key,"
                . "vendor.name as vendorName,"
                . "shortcode.number,service_type.name as serviceTypeName "
                . "from service,service_type,shortcode,vendor where service.type = $type and service.shortcode_id=shortcode.id and "
                . "shortcode.vendor_id=vendor.id "
                . "and service.service_type_id = service_type.id ";

        $result = $this->connection->query($qry);
        $table = null;
        if ($result != null) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $table[] = $row;
                }
            }
        } else {
            General::writeEvent("getServicesByTypeData error " . mysqli_error($this->connection));
        }
        return $table;
    }

    public function getServicesByVendorIdData($vedorID) {
        $qry = "select service.id,service.name as serviceName,"
                . "service.service_code as serviceCode,service.service_key as serviceKey,"
                . "shortcode.number as shortcode,service_type.name as serviceTypeName, "
                . "(select count(*) from service_subscription where service_subscription.service_id = service.id) as subscribersCount "
                . "from  service,service_type,shortcode,vendor "
                . "where service.service_type_id = service_type.id and service.shortcode_id=shortcode.id "
                . "and shortcode.vendor_id=vendor.id and vendor.id = $vedorID ";
        $result = $this->connection->query($qry);
        $table = null;
        if ($result != null) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $table[] = $row;
                }
            }
        } else {
            General::writeEvent("getServicesByClientIDData error " . mysqli_error($this->connection));
        }

        return $table;
    }

    public function getServiceInfoByCodeData($serviceCode) {
        $qry = "select service.id,service.service_key,service.service_code,service.service_method,service.service_code as service_number ,service.creationDate,"
                . "service.name,service.isActive,service.comment,shortcode.number as shortcode,vendor.id as vendorID,"
                . "vendor.name as provider_name,vendor.address as provider_address,vendor.phone as provider_phone,"
                . "vendor.email as provider_email,"
                . "(select count(*) from service_subscription where service_subscription.service_id = service.id) as subscribersCount "
                . "from service,shortcode,vendor  "
                . "where service.shortcode_id=shortcode.id and shortcode.vendor_id=vendor.id and service.service_code = '$serviceCode' ";

        $result = $this->connection->query($qry);
        $row = null;
        //General::writeEvent(" re ".print_r($result));
        if ($result != null) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
        } else {
            General::writeEvent("getServiceInfoByCodeData error " . mysqli_error($this->connection));
        }
        return $row;
    }

    public function getServiceInfoByServiceKeyData($key, $shortcode) {
        $qry = "select service.id, service.name,service.service_key,service.sub_message,service.unsub_message  from service,shortcode  "
                . "where service.service_key = '$key' and service.shortcode_id=shortcode.id and  shortcode.number = '$shortcode'  ";

        $result = $this->connection->query($qry);
        $row = null;
        if ($result != null) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
        } else {
            General::writeEvent("getServiceInfoByServiceKeyData error " . mysqli_error($this->connection));
        }
        return $row;
    }

    public function getServiceKeyInfoData($key, $shortcode) {
        $qry = "select service.id, service.name,service_keys.service_key,service.sub_message,service.unsub_message  "
                . "from service_keys,service,shortcode  "
                . "where service_keys.service_key = '$key' and service_keys.service_id =service.id and service.shortcode_id=shortcode.id and  shortcode.number = '$shortcode'  ";

        $result = $this->connection->query($qry);
        $row = null;
        if ($result != null) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
        } else {
            General::writeEvent("getServiceInfoByServiceKeyData error " . mysqli_error($this->connection));
        }
        return $row;
    }

    public function getServiceInfoByIdData($id) {

        $qry = "select service.id, service.name,service.sender_name,service.free_source,service.service_method,service.sender_name,service.comment,service.service_key,service.service_code,"
                . "service.isActive,service.type,service.creationDate,service.sub_message,service.unsub_message,service.service_type_id,service.shortcode_id,service.sub_service_id,service.unsub_key ,"
                . "shortcode.number,user.name as userName,vendor.id as vendorID,"
                . "service.system_id,service.sender_info,service.type,"
                . "vendor.name as vendorName,vendor.phone as vendorPhone,vendor.address as vendorAddress,"
                . "vendor.email as email,sub_contents.title as subContentTitle ,contents.title as contentTitle, "
                . "(select connection_id from shortcode_connections where shortcode_id = shortcode.id limit 1) as connId "
                . "from service,shortcode,user,vendor,contents,sub_contents  "
                . "where service.id = '$id' and service.shortcode_id=shortcode.id "
                . "and shortcode.vendor_id = vendor.id and service.user_id=user.id "
                . "and service.sub_service_id = sub_contents.content_extra_id and sub_contents.content_id=contents.id   ";

        $result = $this->connection->query($qry);
        $row = null;
        if ($result != null) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
        } else {
            General::writeEvent(mysqli_error($this->connection));
        }
        return $row;
    }

    //  updateStatus  
    public function updateStatus($id, $status, $comment, $userID) {
        $add_qry = "update service set isActive = $status , comment = '$comment',user_id=$userID where id = $id ";

        $isUpdated = $this->connection->query($add_qry);

        if ($isUpdated != TRUE) {
            General::writeEvent("updateStatus error " . mysqli_error($this->connection));
        }

        return $isUpdated;
    }

    public function getServiceKeyInfoBykeyData($serviceId, $serviceKey) {
        $row = null;
        try {
            $stmt = $this->connection->prepare("select * from service_keys where service_id =? and service_key=? ");
            $stmt->bind_param("is", $serviceId, $serviceKey);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result != null && $result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
            }
            $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("getServiceKeyInfoData error" . $e->getMessage());
        }
        return $row;
    }

}
