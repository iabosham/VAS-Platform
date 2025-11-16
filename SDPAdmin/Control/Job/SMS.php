<?php

 class SMS {
     
      public static function send($msisdn , $text,$shortcode){
          
          $jsonFile = json_decode(Config::getJsonFile(),true);
          $url = $jsonFile['sms'].'/PostSMS'.'?tomdn='.$msisdn.'&operatorid=1&shortcodetext='.$shortcode.'&messagetext='.urlencode($text).'&user=alaa&password=alaa';
          $content = file_get_contents($url); 
          $data = json_decode($content,true);
            
          return ($data);
          
      }
    
    
    
}

