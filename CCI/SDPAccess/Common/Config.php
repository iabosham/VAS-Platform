<?php

class Config{
    
    

    static function getJsonFile(){
	
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		  $string = file_get_contents("E:\code\CentralVASConfig.json");
	} 
        else 
	{
		$string = file_get_contents("/etc/code/CentralVASConfig.json");
	}
	return $string ;
 }
      
}
