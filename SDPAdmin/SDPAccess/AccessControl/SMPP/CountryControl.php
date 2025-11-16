<?php
class CountryControl {
   
  
    public static function addCountry($id, $name){
       $resendObj = new CountryDataSource();
       $result =  $resendObj->addCountryData($id, $name);
       $resendObj->close();
       return $result ;
   
   }
 
  
    public static function getCountries(){
       $resendObj = new CountryDataSource();
       $result =  $resendObj->getCountryData();
       $resendObj->close() ;
       return $result ;
   }
   
}