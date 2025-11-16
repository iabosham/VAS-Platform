<?php

class ServiceSubscription extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
     //
     public  function addServiceSubscriptionData($subscriberID,$serviceID,$msisdn){
       $isAdded = false ;
      $add_qry = "insert into service_subscription(subscriber_id,service_id,msisdn) "
              . " values('$subscriberID','$serviceID','$msisdn') " ;
       if ($this->connection->query($add_qry) === TRUE) {
            $isAdded =  true ;
      } else {
         General::writeEvent("addServiceSubscription-- error ".mysqli_error($this->connection));
        }
        
        return $isAdded ;
      }
      
      
       public  function getSerivceSubscribersCountData($serviceID,$fromDate,$toDate, $companyId = 0, $stateId = 0 ){
          
         
        $where = "";

        if ($serviceID > 0) {

            $where .= " and service.id = $serviceID  ";
        }

        if ($stateId == 0) {

            if ($fromDate != null) {

                $where .= " and service_subscription.subscription_date >= '$fromDate'  ";
            }

            if ($toDate != null) {

                $where .= " and service_subscription.subscription_date <= '$toDate'  ";
            }
        } else if ($stateId == 1) {

            if ($fromDate != null) {

                $where .= " and service_subscription.subscription_date >= '$fromDate'  ";
            }

            if ($toDate != null) {

                $where .= " and service_subscription.subscription_date <= '$toDate'  ";
            }
            
            $where .= " and service_subscription.isActive = 1  ";
        } else if ($stateId == 2) {
            
            
            if ($fromDate != null) {

                $where .= " and service_subscription.subscription_date >= '$fromDate'  ";
            }

            if ($toDate != null) {

                $where .= " and service_subscription.subscription_date <= '$toDate'  ";
            }
            
            $where .= " and service_subscription.isActive = 0  ";
        }

        if ($companyId > 0) {
            $where .= " and shortcode.company_id = $companyId  ";
        }


          
          
      $qry = "select count(*) as counts, service.name, shortcode.title ,operators.name as operatorName  "
              . "from service_subscription ,service, shortcode ,operators "
              . "where service_subscription.service_id =service.id "
              . "and  service.shortcode_id=shortcode.id and shortcode.company_id=operators.id and operators.status =1 $where group by service.id "
              . "order by counts desc "
              . "  " ;
      //
      $result = $this->connection->query($qry);
      $table = null ; 
      if ($result != null) {
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
         $table[] = $row;
        }
        } 
      
      }
        return $table ;
      }
       
      
     
      
       public  function getServiceSubscriptionInfoData($subscriberID,$serviceID){
      $qry = "select * from service_subscription  "
              . "where service_subscription.subscriber_id = $subscriberID and service_subscription.service_id=$serviceID  " ;
      
      $result = $this->connection->query($qry);
      $row = null ;
      if($result != null){
      if ($result->num_rows > 0) {
        // output data of each row
         $row = $result->fetch_assoc() ;
         
         } 
         }  
        return $row ;
       
      }
      
     public  function getServiceSubscriptionCountData($serviceID){
         
      $qry = "select count(*) as counts from service_subscription where service_subscription.service_id = $serviceID " ;
      
      $result = $this->connection->query($qry);
      
       
      $row = null ;
      if($result != null){
       if ($result->num_rows > 0) {
        // output data of each row
         $row = $result->fetch_assoc() ;
         
         } 
         }  
        return $row ;
       
      }
      
      
      
        public  function removeSubscriberFromServiceData($subscriberID,$serviceID){
           $rem_qry = "delete from service_subscription where subscriber_id = '$subscriberID' and "
              .  "service_id = '$serviceID' " ;
           if ($this->connection->query($rem_qry) === TRUE) {
               return true ;
           } else {
               General::writeEvent("removeSubscriberFromServiceData-- error ".mysqli_error($this->connection));
               return false ;
      }
      
      }
      
      public  function deleteServiceSubscriptionData($id){
          
           $rem_qry = "delete from service_subscription where id = $id " ;
           
           if ($this->connection->query($rem_qry) === TRUE) {
               return true ;
           } else {
               General::writeEvent("deleteServiceSubscriptionData-- error ".mysqli_error($this->connection));
               return false ;
      }
      
      }
      
      public  function removeSubscriberFromAllServicesData($subscriberID){
           $rem_qry = "delete from service_subscription where subscriber_id = '$subscriberID'  " ;
           if ($this->connection->query($rem_qry) === TRUE) {
               return true ;
           } else {
               General::writeEvent("removeSubscriberFromAllServicesData-- error ".mysqli_error($this->connection));
               return false ;
      }
      
      }
      
       public function getSubscriberServicesData($msisdn) {
         $table = array();
        try {
            $stmt = $this->connection->prepare("select service_subscription.id, service.name,service.service_key,service_subscription.subscription_date "
              . "from subscriber,service_subscription,service "
              . "where subscriber.msisdn = ? and subscriber.id=service_subscription.subscriber_id "
              . "and service_subscription.service_id =service.id ");
            
            $stmt->bind_param("i",$msisdn);
            $stmt->execute();
            $result = $stmt->get_result();
           
            if ($result != null && $result->num_rows > 0) {
                $table =  mysqli_fetch_all($result,MYSQLI_ASSOC) ;
             }
             $stmt->close();
        } catch (Exception $e) {
            General::writeEvent("getSubscriberServicesData error" . $e->getMessage());
        }
        return $table;
    }
    
      public function removeSubscriberFromServiceByMSISDNData($msisdn, $serviceID) {
        $rem_qry = "delete from service_subscription where msisdn = '$msisdn' and "
                . "service_id = '$serviceID' ";
        if ($this->connection->query($rem_qry) === TRUE) {
            return true;
        } else {
            General::writeEvent("removeSubscriberFromServiceData-- error " . mysqli_error($this->connection));
            return false;
        }
    }
      
      
        public function getServiceSubscriptionInfoByMSISDNAndServiceCodeData($msisdn, $serviceCode) {
        $qry = "select service_subscription.*,service.id serviceId, service.name serviceName,service.sub_message,service.unsub_message "
                . "  "
                . " from service_subscription,service,shortcode   "
                . "where service_subscription.msisdn = '$msisdn'  "
                . "and service_subscription.service_id=service.id and service.service_code = $serviceCode and service.shortcode_id=shortcode.id "
                . " ";
        
 
        $result = $this->connection->query($qry);

        $row = null;
        if ($result != null) {
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
            }
        }
        return $row;
    }

    
}
