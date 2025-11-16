<?php

class Shortcode extends DBConnection{
    
     
  function __construct() {
       parent::__construct();
   }
     
     //  Insert new shortcode 
    public  function addShortcodeData($title ,$code,$vendorID,$userID){
      $add_qry = "insert into shortcode (title,number,vendor_id,user_id) "
              . " values('$title','$code','$vendorID','$userID') " ;
       if ($this->connection->query($add_qry) === TRUE) {
            return true ;
      } else {
         General::writeEvent("addShortcode-- error ".mysqli_error($this->connection));
            return false ;
      }
      $this->connection->close();
      }
       
      
      public  function getShortcodesData(){
      $qry = "select shortcode.id,shortcode.title,shortcode.number,vendor.name as vendorName,"
              . "user.name as userName  "
              . "from shortcode,vendor,user "
              . "where shortcode.vendor_id = vendor.id and shortcode.user_id=user.id " ;
      
      $result = $this->connection->query($qry);
      
      if ($result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
         $table[] = $row;
        }
        return $table ;
        } else {
           return null ;
        }
        $this->connection->close();
       
      }
      
      public  function getShortcodesByVendorIdData($vendorID){
      $qry = "select shortcode.id,shortcode.title,shortcode.number "
               . "from shortcode "
              . "where shortcode.vendor_id = $vendorID " ;
      
      $result = $this->connection->query($qry);
      
      if ($result != null && $result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
         $table[] = $row;
        }
        return $table ;
        } else {
           return null ;
        }
        $this->connection->close();
       
      }
      
       public  function getShortcodeInfoByNumberData($number){
      $qry = "select * from shortcode  "
              . "where shortcode.number = $number " ;
      
      $result = $this->connection->query($qry);
      
      if ($result->num_rows > 0) {
        // output data of each row
         $row = $result->fetch_assoc() ;
          return $row ;
        } else {
           return null ;
        }
        $this->connection->close();
       
      }
      
       public  function getShortcodeInfoByIdData($id){
      $qry = "select shortcode.id,shortcode.title,shortcode.number,shortcode.isActive"
              . ",user.name as userName"
              . ",vendor.name as vendorName,vendor.address,vendor.phone,vendor.email"
              . ",vendor.description "
              . "from shortcode,vendor,user  "
              . "where shortcode.id = $id and shortcode.vendor_id=vendor.id and shortcode.user_id=user.id " ;
      
      $result = $this->connection->query($qry);
      
      if ($result->num_rows > 0) {
        // output data of each row
         $row = $result->fetch_assoc() ;
          return $row ;
        } else {
           return null ;
        }
        $this->connection->close();
       
      }
      
      
       
    
}
