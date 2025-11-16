<?php
class CompanyControl {
   
  
    public static function addCompany($id, $name){
       $resendObj = new CompanyDataSource();
       $result =  $resendObj->addCompanyData($id, $name);
       $resendObj->close();
       return $result ;
   
   }
 //
  
    public static function getCompanies(){
       $resendObj = new CompanyDataSource();
       $result =  $resendObj->getCompanyData();
       $resendObj->close() ;
       return $result ;
   }
   
     public static function getCompanyInfo($id){
       $resendObj = new CompanyDataSource();
       $result =  $resendObj->getCompanyInfoByIdData($id);
       $resendObj->close() ;
       return $result ;
   }
   
}