<?php
class Code{
public static function getSDPAccessPath(){
    
   $rootPath =  filter_input(INPUT_SERVER, "DOCUMENT_ROOT") ;
   
   return $rootPath.'/SDPAccess' ;
 }
     
        
}
 