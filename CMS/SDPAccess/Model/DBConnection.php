<?php  
 
//import required files
  class DBConnection{
   public $connection ;
   
   function __construct() {
        $this->getConnection();
    }
    
    public function close(){
      $this->connection->close();  
    }
   
         // getConnection, used for Database classes to initialize database connection
        public  function getConnection(){
         // Read configuration from smsweb.json file
         $jsonFileName = General::getConfigurationFile(); 
         $database =General::getConfigurationParameter("database", "", "$jsonFileName");
         $server =General::getConfigurationParameter("server", "","$jsonFileName");
         $port =General::getConfigurationParameter("port", "","$jsonFileName");
         $username =General::getConfigurationParameter("username", "", "$jsonFileName");
         $password =General::getConfigurationParameter("password","", "$jsonFileName");
        
      try {
               
         // Create connection
         $connection = new mysqli($server,$username,$password,$database,$port);
        
         if(!$connection){
             General::writeEvent ("Error in get Connection ".$connection) ;
 		    die('error: 9910!' . mysql_error());
          }else {
          //to read arabic
          //mysqli_set_charset($connection,'utf8');
          //mysqli_query($connection,"SET CHARACTER_SET utf8;");
          //mysqli_select_db($connection,$database); 
          $this->connection = $connection;
           
         }
         } catch (Exception $exception) {
            /* @var $lastError type */
            $lastError = $exception->getMessage() ;
            General::writeEvent($lastError);
        }
        }
     
      
 }
 
 
 
 
 