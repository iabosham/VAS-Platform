<?php
class UserControl extends User{
   
   public static function getUsers($system =1){
       $userObj = new User();
   return $userObj->getUsersData($system);
   
   }
   
   public static function getUserInfoById($userId){
       $userObj = new User();
   return $userObj->getUserInfoByIdData($userId);
   
   }
   
   public static function checkLogin($login, $password,$systemId =1){
       $userObj = new User();
   return $userObj->checkLoginData($login, $password, $systemId) ;
   
   }
   
    public static function addUser($name, $login, $password, $type, $email, $phone,$sys=1) { 
       $userObj = new User();
   return $userObj->addUserData($name, $login, $password, $type, $email, $phone,$sys);
   
   }
   
   public static function updateUser($id, $name, $login, $type, $email, $phone,$status,$secret = null) { 
       $userObj = new User();
   return $userObj->updateUserData($id, $name, $login, $type, $email, $phone,$status,$secret) ;
   
   }
   public static function changeUserPassword($id, $password){
       $userObj = new User();
   return $userObj->changeUserPasswordData($id, $password) ;
   
   }
   
}