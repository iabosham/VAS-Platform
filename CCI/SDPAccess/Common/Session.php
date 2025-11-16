<?php

class Session{
    
    
     static public  $ENVALED_LOGIN = "RCMS_ENVALED_LOGIN" ;
     static public  $SUCCESS_INSERTION = "RCMS_SUCCESS_INSERTION" ;
     static public  $ENVALED_INSERTION = "RCMS_ENVALED_INSERTION" ;
     static public  $SUCCESS_OPERATION = "RCMS_SUCCESS_OPERATION" ;
     static public  $ENVALED_OPERATION = "RCMS_ENVALED_OPERATION" ;
     
     static public function setSessionValue($key,$value){
         $_SESSION[$key] = $value ;
     } 
       
     static public function getSessionValue($key){
         return $_SESSION[$key]   ;
     } 
	 
	 
 }
 
