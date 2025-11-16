<?php

class Cookie{
     
   public static function setId($id){
    setcookie("CCI11",$id,time()+60*60*24*30,'/');
    }
  
    public static function setName($name){
         setcookie("CCI22",$name,time()+60*60*24*30,'/');
    }
    public static function setLogin($login){
         setcookie("CCI33",$login,time()+60*60*24*30,'/');
    }
     public static function setUserType($type){
         setcookie("CCI44",$type,time()+60*60*24*30,'/');
    }
     public static function setSystemID($id){
         setcookie("CCI55",$id,time()+60*60*24*30,'/');
    }
     public static function setCompanyID($id){
         setcookie("CCI66",$id,time()+60*60*24*30,'/');
    }
    
       public static function setCompanyName($name){
         setcookie("CCI77",$name,time()+60*60*24*30,'/');
    }
    
    public static function isLogin(){
        if(isset($_COOKIE["CCI11"])){
              return true ;
        }else {
            return false ;
        }
    }
     
    public static function getUserId(){
        return $_COOKIE["CCI11"] ; 
    }
    public static function getUserName(){
        return $_COOKIE["CCI22"] ; 
    }
    public static function getUserLogin(){
        return $_COOKIE["CCI33"] ; 
    }
      public static function getUserType(){
        return $_COOKIE["CCI44"] ; 
    }
      public static function getSystemID(){
        return $_COOKIE["CCI55"] ; 
    }
    
       public static function getCompanyID(){
        return $_COOKIE["CCI66"] ; 
    }
    
       public static function getCompanyName(){
           
           if(isset($_COOKIE["CCI77"])){
                 return $_COOKIE["CCI77"] ; 
           }  else {
              return "Unknown"; 
           }
      
    }
    
     public static function removeCookies(){
       setcookie("CCI11", "",time()-60*60*24*30,'/');
       setcookie("CCI22", "",time()-60*60*24*30,'/');
       setcookie("CCI33", "",time()-60*60*24*30,'/');
       setcookie("CCI44", "",time()-60*60*24*30,'/');
       setcookie("CCI55", "",time()-60*60*24*30,'/');
       setcookie("CCI66", "",time()-60*60*24*30,'/');
       setcookie("CCI77", "",time()-60*60*24*30,'/');

    }
}
 