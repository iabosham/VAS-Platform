<?php

class Validation{
 
    public static function validateEmail($value){
        
         if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value)) {
               return false;
          }else {
               return true ;
          }
    }
       public static function validateNumber($value){

          if (!is_numeric($value)) { 
 	      $_SESSION[$errorTitle] = 'invalid number format';
	      return false ;
          }else {
              return true ;
          }
    }
}