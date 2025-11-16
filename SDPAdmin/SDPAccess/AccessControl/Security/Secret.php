<?php
class Secret extends Security {
    
public static function getProviderKey($key, $data){
 $securityObj = new Security();  
 $providerKey = $securityObj->hmacBase64($key, $data) ;
 return $providerKey ;   
 } 

}
