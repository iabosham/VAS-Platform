<?php

class Subscriber extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
     
     //  Insert new subscriber 
    public  function addSubscriberData($msisdn){
      $last_id = 0 ;
      $add_qry = "insert into subscriber(msisdn) "
              . " values('$msisdn') " ;
       if ($this->connection->query($add_qry) === TRUE) {
            $last_id = $this->connection->insert_id; 
      } else {
         General::writeEvent("addSubscriber-- error ".mysqli_error($this->connection));
          
      }
          return $last_id;
      }
       
      
      public  function getSubscribersOfSerivce($serviceID){
      $qry = "select distinct subscriber.id,service_subscription.subscription_date as creationDate,subscriber.msisdn  "
              . "from service_subscription,subscriber,service "
              . "where service_subscription.subscriber_id=subscriber.id "
              . "and  service_subscription.service_id=service.id and service.id = $serviceID  "
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
      
      public  function getSubscriberServicesData($subscriberID){
      $qry = "select service.name as service_name,service.service_code,service_subscription.subscription_date  "
              . "from service_subscription,subscriber,service "
              . "where service_subscription.subscriber_id=subscriber.id and  service_subscription.service_id=service.id and subscriber.id = $subscriberID   " ;
      
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
      
        public  function getSubscriberServicesByServiceTypeData($subscriberID,$type){
      $qry = "select service.name as service_name,service.service_key,service.service_code,service_subscription.subscription_date  "
              . "from service_subscription,subscriber,service "
              . "where service.type = $type and service_subscription.subscriber_id=subscriber.id and  service_subscription.service_id=service.id and subscriber.id = $subscriberID   " ;
      
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
      
      
     public  function getSubscriberInfoByNumberData($msisdn){
           
      $row = null ;
      $qry = "select * from subscriber  "
              . "where subscriber.msisdn = $msisdn " ;
      
       $result = $this->connection->query($qry);
      
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc() ;
         } 
         
       return $row ;
       
       
      }
      
       
    
}
