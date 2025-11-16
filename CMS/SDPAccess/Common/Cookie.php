<?php

class Cookie{
     
   public static function setId($id){
    setcookie("SDPS11",$id,time()+60*60*24*30,'/');
    }
  
    public static function setName($name){
         setcookie("SDPS22",$name,time()+60*60*24*30,'/');
    }
    public static function setLogin($login){
         setcookie("SDPS33",$login,time()+60*60*24*30,'/');
    }
     public static function setUserType($type){
         setcookie("SDPS44",$type,time()+60*60*24*30,'/');
    }
     public static function setSystemID($id){
         setcookie("SDPS55",$id,time()+60*60*24*30,'/');
    }
    
    public static function isLogin(){
        if(isset($_COOKIE["SDPS11"])){
              return true ;
        }else {
            return false ;
        }
    }
     
    public static function getUserId(){
        return $_COOKIE["SDPS11"] ; 
    }
    public static function getUserName(){
        return $_COOKIE["SDPS22"] ; 
    }
    public static function getUserLogin(){
        return $_COOKIE["SDPS33"] ; 
    }
      public static function getUserType(){
        return $_COOKIE["SDPS44"] ; 
    }
      public static function getSystemID(){
        return $_COOKIE["SDPS55"] ; 
    }
    
     public static function removeCookies(){
       setcookie("SDPS11", "",time()-60*60*24*30,'/');
       setcookie("SDPS22", "",time()-60*60*24*30,'/');
       setcookie("SDPS33", "",time()-60*60*24*30,'/');
       setcookie("SDPS44", "",time()-60*60*24*30,'/');
       setcookie("SDPS55", "",time()-60*60*24*30,'/');

    }
}
 