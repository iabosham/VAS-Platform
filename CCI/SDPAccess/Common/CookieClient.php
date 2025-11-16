<?php

class CookieClient{
     
   public static function setId($id){
    setcookie("CMSC11",$id,time()+60*60*24*30,'/');
    }
  
    public static function setName($name){
         setcookie("CMSC22",$name,time()+60*60*24*30,'/');
    }
    public static function setLogin($login){
         setcookie("CMSC33",$login,time()+60*60*24*30,'/');
    }
     public static function setUserType($type){
         setcookie("CMSC44",$type,time()+60*60*24*30,'/');
    }
     public static function setSystemID($id){
         setcookie("CMSC55",$id,time()+60*60*24*30,'/');
    }
    
    public static function isLogin(){
        if(isset($_COOKIE["CMSC11"])){
              return true ;
        }else {
            return false ;
        }
    }
     
    public static function getUserId(){
        return $_COOKIE["CMSC11"] ; 
    }
    public static function getUserName(){
        return $_COOKIE["CMSC22"] ; 
    }
    public static function getUserLogin(){
        return $_COOKIE["CMSC33"] ; 
    }
      public static function getUserType(){
        return $_COOKIE["CMSC44"] ; 
    }
      public static function getSystemID(){
        return $_COOKIE["CMSC55"] ; 
    }
    
     public static function removeCookieClients(){
       setcookie("CMSC11", "",time()-60*60*24*30,'/');
       setcookie("CMSC22", "",time()-60*60*24*30,'/');
       setcookie("CMSC33", "",time()-60*60*24*30,'/');
       setcookie("CMSC44", "",time()-60*60*24*30,'/');
       setcookie("CMSC55", "",time()-60*60*24*30,'/');

    }
}
 