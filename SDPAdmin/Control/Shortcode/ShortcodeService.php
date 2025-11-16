<?php

class ShortcodeService {
 
    
    public static function addShortcode($params){
      try{
         
           $jsonFileName = General::getConfigurationFile(); 
           $wsPath = General::getConfigurationParameter("interface", "",$jsonFileName);
           $url = $wsPath.'AddShortcode';
           $jsonData = General::callURL($url, json_encode($params)); 
           $data = json_decode($jsonData);
           if($data != null && $data->result = true){
              return true;
            }else {
             General::writeEvent("addShortcode to gateway error error:".$jsonData);  
             return false ;
           }
      }catch(Exception $e){
            General::writeEvent("addShortcode to gateway error:".$e);
             return false ;
      }
        
    }
    
     
}

