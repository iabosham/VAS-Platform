<?php
class UserControl extends User{
   
   public static function getUsers($system =1){
       $userObj = new User();
   return $userObj->getUsersData($system);
   //
   }
   
   public static function getUserInfoById($userId){
       $userObj = new User();
   return $userObj->getUserInfoByIdData($userId);
   
   }
   
   public static function checkLogin($login, $password){
       $userObj = new User();
   return $userObj->checkLoginData($login, $password) ;
   
   }
   //
    public static function addUser($name, $login, $password, $type, $email, $phone,$sys,$companyId=0) { 
       $userObj = new User();
   return $userObj->addUserData($name, $login, $password, $type, $email, $phone,$sys,$companyId);
   
   }
   
   public static function updateUser($id, $name, $login, $type, $email, $phone,$status,$secret,$companyId) { 
       $userObj = new User();
   return $userObj->updateUserData($id, $name, $login, $type, $email, $phone,$status,$secret,$companyId) ;
   
   }
   public static function changeUserPassword($id, $password){
       $userObj = new User();
   return $userObj->changeUserPasswordData($id, $password) ;
   
   }
   
}