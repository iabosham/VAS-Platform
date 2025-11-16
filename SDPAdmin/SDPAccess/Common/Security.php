<?php

class Security {
    
  public static function hmacBase64($key,$data){
      $text = base64_encode(hash_hmac('sha256',$data,$key,true));
      return $text ;
  }  
  
   public static function encodeToBase64($data){
      $text = base64_encode($data);
      return $text ;
  }  
   public static function decodeBase64($data){
      $text = base64_decode($data);
      return $text ;
  } 
  
  
  public static function encrypt($publicKey,$data){
      $output = null ;
      openssl_public_encrypt($data, $output, $publicKey);
      return $output ;
  }
  
  public static function decrypt($privateKey,$data){
          $output = null ;
          openssl_private_decrypt($data, $output, $privateKey); 
          
           return $output ;
  }
 
  public static function getAuthorizationValue(){
  
       $token = null;
        $headers = apache_request_headers();
        if(isset($headers['Authorization'])){
           $token  = $headers['Authorization'] ; 
          }else if(isset($headers['authorization'])) {
           $token  = $headers['authorization'] ; 
          }
        return  $token ;
       }
       
  public static function readFile($file){
    $fp=fopen ($file,"r");
    $data=fread($fp,8192);
    fclose($fp);
    
    return $data ;
  }
  
  public static function isValidAuthorization($privateKey,$secret,$login,$uuid){
       $authorization = Security::getAuthorizationValue() ;
        $providerKey = Security::hmacBase64($secret,$login);
         Security::decodeBase64($authorization) ;
        $value1 = $providerKey.$uuid ;
        
          $value2 = Security::decrypt($privateKey,Security::decodeBase64($authorization));
          $value3 = str_replace(chr(0),"", $value2) ;
          
        if($value3 == $value1){
             return true ;
        }else {
            return false ;
        }
  }
  
  
}
