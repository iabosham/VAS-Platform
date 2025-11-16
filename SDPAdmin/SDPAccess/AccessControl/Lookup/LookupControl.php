<?php
class LookupControl  {
   
 
   
    public static function getStatusLookup(){
       $contentTypeObj = new Lookup();
       $result = $contentTypeObj->getStatusLookupData();
       $contentTypeObj->close();
       return $result;
   
   }
    
   
}