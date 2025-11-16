<?php
class ClientControl extends Client{
   
   public static function getClients(){
       $clientObj = new Client();
   return $clientObj->getClientsData();
   
   }
   
    public static function getClientsByVendorId($vendorId){
       $clientObj = new Client();
   return $clientObj->getClientsByVendorIdData($vendorId);
   
   }
   
    public static function getClientInfoById($id){
       $clientObj = new Client();
       return $clientObj->getClientInfoByIdData($id);
   
   }
   
     public static function clientLogin($login, $password){
       $clientObj = new Client();
       return $clientObj->clientLoginData($login, $password);
    }
   
   
   public static function AddClient($name, $login, $secret, $phone, $email, $status, $isActive, $vendorID, $userType, $isApprove , $isAdmin = 0, $userId = 0){
       $clientObj = new Client();
   return $clientObj->addClientData($name, $login, $secret, $phone, $email, $status, $isActive, $vendorID, $userType, $isApprove, $isAdmin, $userId);
   
   }
   
    public static function updateClient($id, $name, $login, $email, $phone) { 
       $clientObj = new Client();
   return $clientObj->updateClientData($id, $name, $login, $email, $phone) ;
   
   }
   public static function RestClientPassword($password, $id){
       $clientObj = new Client();
   return $clientObj->restClientPasswordData($password, $id) ;
   
   }
   
//   public static function getClientInfoById($clientID){
//       $clientObj = new Client();
//      return $clientObj->getClientInfoData($clientID);
//   
//   }
   
}