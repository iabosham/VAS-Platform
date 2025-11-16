<?php  
 
//import required files
require_once '../Common/General.php';
 
 class MysqlConnection{
     var $lastError = "" ;
     var  $connection ;
     // getConnection, used for Database classes to initialize database connection
     static public function getConnection(){
        // Read configuration from smsweb.json file
        $database =General::getConfigurationParameter("database", "sms", "");
        $server =General::getConfigurationParameter("server", "", "");
        $username =General::getConfigurationParameter("username", "", "");
        $password =General::getConfigurationParameter("password", "", "");
           try {
        // Connect to firebird database serer
        $connection = mysql_connect($server,$username,$password);
         if(!$connection){
             General::writeEvent ("Error in get Connection ".$connection) ;
 		die('error: 9910!' . mysql_error());
	 
         }
        //to read arabic
         //mysql_set_charset('utf8',$connection);
        // mysql_query("SET CHARACTER_SET utf8;");
         mysql_select_db($database); 
        
        } catch (Exception $exception) {
            /* @var $lastError type */
            $lastError = $exception->getMessage() ;
            General::writeEvent($lastError);
         }
     }
     
       static public function closeConnection(){}
     
     static public function getLastError(){
         
         return $lastError ;
     }
     
 }
 
 MysqlConnection::getConnection();
 
 
 