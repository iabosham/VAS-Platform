<?php

class Cookie{
     
   public static function setId($id){
    setcookie("CMS11",$id,time()+60*60*24*30,'/');
    }
  
    public static function setName($name){
         setcookie("CMS22",$name,time()+60*60*24*30,'/');
    }
    public static function setLogin($login){
         setcookie("CMS33",$login,time()+60*60*24*30,'/');
    }
     public static function setUserType($type){
         setcookie("CMS44",$type,time()+60*60*24*30,'/');
    }
     public static function setSystemID($id){
         setcookie("CMS55",$id,time()+60*60*24*30,'/');
    }
     public static function setCompanyID($id){
         setcookie("CMS66",$id,time()+60*60*24*30,'/');
    }
    
       public static function setCompanyName($name){
         setcookie("CMS77",$name,time()+60*60*24*30,'/');
    }
    
    public static function isLogin(){
        if(isset($_COOKIE["CMS11"])){
              return true ;
        }else {
            return false ;
        }
    }
     
    public static function getUserId(){
        return $_COOKIE["CMS11"] ; 
    }
    public static function getUserName(){
        return $_COOKIE["CMS22"] ; 
    }
    public static function getUserLogin(){
        return $_COOKIE["CMS33"] ; 
    }
      public static function getUserType(){
        return $_COOKIE["CMS44"] ; 
    }
      public static function getSystemID(){
        return $_COOKIE["CMS55"] ; 
    }
    
       public static function getCompanyID(){
        return $_COOKIE["CMS66"] ; 
    }
    
       public static function getCompanyName(){
           
           if(isset($_COOKIE["CMS77"])){
                 return $_COOKIE["CMS77"] ; 
           }  else {
              return "Unknown"; 
           }
      
    }
    
     public static function removeCookies(){
       setcookie("CMS11", "",time()-60*60*24*30,'/');
       setcookie("CMS22", "",time()-60*60*24*30,'/');
       setcookie("CMS33", "",time()-60*60*24*30,'/');
       setcookie("CMS44", "",time()-60*60*24*30,'/');
       setcookie("CMS55", "",time()-60*60*24*30,'/');
       setcookie("CMS66", "",time()-60*60*24*30,'/');
       setcookie("CMS77", "",time()-60*60*24*30,'/');

    }
}
 