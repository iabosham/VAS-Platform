<?php

 class SMS {
     
      public static function send($msisdn , $text,$shortcode){
          
          $jsonFile = json_decode(Config::getJsonFile(),true);
          $url = $jsonFile['sms'].'/PostSMS'.'?tomdn='.$msisdn.'&operatorid=1&shortcodetext='.$shortcode.'&messagetext='.urlencode($text).'&user=alaa&password=alaa';
          $content = file_get_contents($url); 
          $data = json_decode($content,true);
            
          return ($data);
          
      }
      
      public static function sendInfoMessage($msisdn , $text ,$shortcode = "info"){
          $jsonFileName = General::getConfigurationFile(); 
          $username =General::getConfigurationParameter("sms_gateway_username", "vas", "$jsonFileName");
          $password =General::getConfigurationParameter("sms_gateway_password", "vas@124","$jsonFileName");
          
          $shortcodeInfo =General::getConfigurationParameter("sms_gateway_shortcode", "info","$jsonFileName");
          if($shortcodeInfo != ""){
              $shortcode = $shortcodeInfo; 
          }
          $operatorId =General::getConfigurationParameter("sms_gateway_operator_id",1,"$jsonFileName");
          $params = array();
          $params['user'] = $username ;
          $params['password'] = $password ;
          $params['operatorid'] = $operatorId ;
          $params['shortcodetext'] = $shortcode ;
          $params['tomdn'] = $msisdn ;
          $params['messagetext'] = $text ;
          $jsonFile = json_decode(Config::getJsonFile(),true);
          $url = $jsonFile['sms'].'/PostSMSJSON';
          $content = General::callURL($url, json_encode($params));
          
          General::writeEvent($content);
          //$content = file_get_contents($url); 
          $data = json_decode($content,true);
            
          return ($data);
          
      }
      
      public static function sendSystemMessage($msisdn ,$messageCode,$shortcode = "info"){ 
      
         $systemMessageInfo = SystemMessageControl::getSystemMessagesByCode($messageCode);
                    
            if($systemMessageInfo != null){
                SMS::sendInfoMessage($msisdn,$systemMessageInfo['message'],$shortcode);
             }
                     
      }
    
    
    
}

