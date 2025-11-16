<?php

 class General{
     
      static  $msg_err = array();
      static  $msg_succ = array();
      static $errorFlage = false ;
      static $succFlage = false ;
 
      public static function writeEvent2($Activity){
		
		$TimeRef = date('Y-m-d H:i:s');
		$date = date('Y-m-d');
		///////////////////////////////////////////////
		if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
		  $fileName = "E:\External\log\sdp\sdp_log"."_".$date.".log";
		} else {
		  $fileName = "/var/log/sdp/sdp_log"."_".$date.".log";
		}
		
		$Handle = fopen($fileName, 'a');
		if(!$Handle){
		$Handle = fopen($fileName, 'w'); 
                }
		$Data ='--- '.$TimeRef.' -- '.$Activity."~\n";
		fwrite($Handle, $Data);
		fclose($Handle);
    }
    
    public static function writeEvent($Activity,$fileName="ticket"){
		
		$TimeRef = date('Y-m-d H:i:s');
		$date = date('Y-m-d');
		///////////////////////////////////////////////
		if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
		  $fileName = "E:\External\log\sdp\sdp_log"."_".$date.".log";
		} else {
		  $fileName = "/var/log/sdp/sdp_log"."_".$date.".log";
		}
		
		$Handle = fopen($fileName, 'a');
		if(!$Handle){
		$Handle = fopen($fileName, 'w'); 
                }
		$Data ='--- '.$TimeRef.' -- '.$Activity."~\n";
		fwrite($Handle, $Data);
		fclose($Handle);
    }
    
      public static function writeEventCron($Activity){
		
		$TimeRef = date('Y-m-d H:i:s');
		$date = date('Y-m-d');
		///////////////////////////////////////////////
		if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
		  $fileName = "E:\External\log\sdp\cron_sdp_log"."_".$date.".log";
		} else {
		  $fileName = "/var/log/sdp/cron_sdp_log"."_".$date.".log";
		}
		
		$Handle = fopen($fileName, 'a');
		if(!$Handle){
		$Handle = fopen($fileName, 'w'); 
                }
		$Data ='--- '.$TimeRef.' -- '.$Activity."~\n";
		fwrite($Handle, $Data);
		fclose($Handle);
    }
    
    public static function callURL($url, $params){
           try {
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_POST, 1);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt( $ch, CURLOPT_HEADER, 0);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

           return $response = curl_exec( $ch ); 
            }  catch (Exception $exception) {
            General::writeEvent("callURL error: ".$exception->getMessage()) ;
           }
           }
    
    public static function getConfigurationParameter($parameterName, $defaulValue,$jsonFileName){
        try {
		  if(file_exists($jsonFileName)){
                    
                        $jsonFileNameContent = file_get_contents($jsonFileName);
                        $value = json_decode($jsonFileNameContent,true) ;
                         
                        return $value[$parameterName] ;
                 } else {
                        return $defaulValue ;
                 }  
                   
           }  catch (Exception $exception) {
            General::writeEvent($exception->getMessage()) ;
                
          }
  
          }
          
           public static function getConfigurationFile(){
               $jsonFileName = null ;
           if(strncasecmp(PHP_OS, 'WIN', 3) == 0){
               $jsonFileName = "E:\\External\\SDPConfig\\SDPConfig.json";
            }  else {
               $jsonFileName = "/etc/sdp/SDPConfig.json";
            }
            
            return $jsonFileName ;
  
          }
          
  
     
     public static function getProjectPath(){
         $path = null; 
          if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
                $path = "../../";
            } else {
                $path = "/var/www/html/";
            }
     }
     
     public static function clean($param) {
         $strValue = filter_input(INPUT_POST, $param) ;
		$str = trim($strValue);
 			$str = stripslashes($str);
 		return ($str);
	}
        
        public static function cleanGet($param) {
         $strValue = filter_input(INPUT_GET, $param) ;
		$str = trim($strValue);
 			$str = stripslashes($str);
   		return ($str);
	}
        
        public static function getRequestData() {
               $strValue = file_get_contents('php://input');
           if($strValue == null){
               
               $strValue = urldecode(filter_input(INPUT_SERVER,'QUERY_STRING')) ;
               General::writeEvent("QUERY_STRING : ".$strValue); 
           }else {
               General::writeEvent("input : ".$strValue); 
           }
           
          
  	     $str = trim($strValue);
		 
	    return $str;
	}
        
         
        

       public static function isJson($string) {
             (json_decode($string));
        if(json_last_error() == 0){
            return true ;
        }else {
            return false ;
        }
         }
         
          public static function getJsonData($string) {
           return   (stripslashes(stripslashes($string)));
        
         }
         
         



     public static function isNull($filed , $messageValue){
             if($filed == '') {
		General::addError($messageValue)  ;
                return true ;
              } else {
                  return false ;
              }
     }
     public static function validateNumber($value,$messageValue){
         
         if (!is_numeric($value))
           {
               General::addError($messageValue)  ;
               return false ;
            }else {
               return true ;
           }
     }
      public static function validateEmail($value , $messageValue){
         
         if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value))
           {
               General::addError($messageValue)  ;
               return false ;
           }else {
                return true ;
           }
     }
     
     public static function validateDate($m,$d,$y,$messageValue)
        {
            if(checkdate($m, $d, $y)){
            return true ;
            }else{
            General::addError($messageValue)  ;
            return false;
            }
        }
        
    public static function validateFile($value,$messageValue){
         
 if (isset($_FILES[$value]) && $_FILES[$value]['size'] > 0) {  
               return true ;
            }else {
                 General::addError($messageValue)  ;
               return false ;
           }
     }
     
     public static function changeConfige(){
         session_cache_limiter('public');
     }
     
     
     public static function addError($err){
         //General::$msg_err[] = $err ;
         array_push(General::$msg_err, $err);
         General::setErrorFlage(true);
         
      }
      public static function addResult($re){
         array_push(General::$msg_succ, $re);
         General::setSuccessFlage(true);
      }
     
     public static function getResult(){
          return General::$msg_succ;
      } 
     public static function getError(){
          return General::$msg_err;
      }
     
     public static function getErrorFlage(){
         
         return General::$errorFlage;
        
     }
     
    public static function getSuccFlage(){
          return General::$succFlage;
      }
     
     public static function setErrorFlage($errorFlage){
         General::$errorFlage = $errorFlage ;
      }    
      public static function setSuccessFlage($succFlage){
         General::$succFlage = $succFlage ;
      }
 
 
    public static function getUserTypes(){
       
             $perm = array(
              array(1,"Adminstrator"),
              array(2,"Operator"),
              array(3,"Manager "),
              array(4,"Super Admin")
             );
    return $perm ;
    }
    
    public static function getContentUserTypes(){
       
             $perm = array(
              array(1,"Adminstrator"),
              array(2,"Approve & Enter Content"),
              array(3,"Approve Content"),
              array(4,"Enter Content") 
              );
   
             return $perm ;
    }
    
      public static function getUserStatus(){
       
             $perm = array(
              array(1,"Not Active","#FF4829"),
              array(2,"Active","#6ac608") 
               
             );
    return $perm ;
    }
    
    public static function getServiceMethod(){
       
             $perm = array(
              array(1,"Normal"),
              array(2,"Sequential"),
              array(3,"MSDP ")
              );
    return $perm ;
    }
    
    public static function getContentTypes(){
       
             $perm = array(
              array(1,"SMS"),
              array(2,"MMS"),
              array(3,"WAP ")
              );
    return $perm ;
    }
    
       public static function getMessageStatus(){
       
             $perm = array(
              array(1,"Pending"),
              array(2,"Sent"),
              array(3,"Sent"),
              array(4,"Failed")
              );
    return $perm ;
    }
    
      public static function getMessageOrders(){
       
             $perm = array(
              array(1,"First Message"),
              array(2,"Second Message"),
              array(3,"Third Message"),
              array(4,"Fourth Message "),
              array(5,"5 "),
              array(6,"6"),
              array(7,"7"),
              array(8,"8")
              );
    return $perm ;
    }
    
    public static function getContentMessageStatus(){
       
             $perm = array(
              array(0,"Pending","#FFFBAA"),
              array(1,"Sent","#C1F4B4"),
              array(2,"Delivered","#FFCAC1"),
              array(3,"Failed","#FFCAC1") 
               
              );
    return $perm ;
    }
    
    public static function getApprovalStatus(){
       
             $perm = array(
              array(0,"Approved","yellow"),
              array(1,"Not Approved","green") 
                
              );
    return $perm ;
    }
    
    public static function getRounds(){
       
             $perm = array(
              array(0,"Round 0","#009688"),
              array(1,"Round 1","#2196F3"),
              array(2,"Round 2","#CDDC39"), 
              array(3,"Round 3","#CDDC39") 
                
              );
    return $perm ;
    }
   
    
    public static function getSystemID(){
     return User::getSystemID() ;
    }
    
    public static function getWeekEndHours($id){
        User::setSystemID($id) ;      
    }
 public static function getHourse($from,$to){
    $timestamp1 = strtotime($from);
$timestamp2 = strtotime($to);

$weekend = array(0, 6);

if(in_array(date("w", $timestamp1), $weekend) || in_array(date("w", $timestamp2), $weekend))
{
    //one of the dates is weekend, return 0?
    return 0;
}

//bng_ivr@888, spice!@777, Alwesam_ivr@#111

$diff = $timestamp2 - $timestamp1;
$one_day = 60 * 60 * 24; //number of seconds in the day

if($diff < $one_day)
{
    return floor($diff / 3600);
}

$days_between = floor($diff / $one_day);
$remove_days  = 0;

for($i = 1; $i <= $days_between; $i++)
{
   $next_day = $timestamp1 + ($i * $one_day);
   if(in_array(date("w", $next_day), $weekend))
   {
      $remove_days++; 
   }
}

return floor(($diff - ($remove_days * $one_day)) / 3600);

}

 public static function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h:%i:%s '); 
      //return  gmdate("d H:i:s",$seconds);
}
    public static function secondsToHours($seconds) {
       $dtF = new DateTime("@0");
       $dtT = new DateTime("@$seconds");
       return $dtF->diff($dtT)->format('%h'); 
         //return  gmdate("d H:i:s",$seconds);
    }

    public static function isAllowedFileType($extension){
            $allowedExts = array("pem");  
               if (in_array($extension, $allowedExts))
             {
                return true ;
             }else { return false; }
    }
     public static function getFileString($inputName,$errMessage){
      $fileString = null; 
       $isFileExist  = General::validateFile($inputName,$errMessage);
 
              if($isFileExist){
                    $data = $_FILES[$inputName]['tmp_name'] ;
                    $fileName = $_FILES[$inputName]['name'] ;
                    $tmp = explode(".", $fileName);
                    $extension = end($tmp);
                    
                   if(General::isAllowedFileType($extension)){
                      $fileString  =Security::readFile($data);
                     }else {
                      General::writeEvent($inputName. " file ext not allowed ");
                    }
                    }
       return $fileString ;    
      }
      
      public static function getHeaderValue($key){
  
       $token = null;
        $headers = apache_request_headers();
        if(isset($headers[$key])){
          $token  = $headers[$key] ; 
          } 
        return  $token ;
       }
       
        public static function removeZero($number) {
             $number = General::removeSpace($number);
             $value = substr($number, 0,1)  ; 
             
             if(strcmp($value,"0") == 0){
                   $number = substr($number, 1);
            }
             
             return $number ;

        }

       
       public static function add249($number) {
           
            $number = General::removeZero($number);
           
            if(is_numeric($number) ){
              
           if(strlen($number) == 9){
                 $number = "222".$number ;
            }
            
            }
           
           
           return $number ;
           
        }
        
   public static function removeSpace($string){
       
       $string = preg_replace('/\s+/', '', $string);
       
       return $string ;
   }
   
   public static function checkLogin(){
        $id = Cookie::getUserId() ;
         if($id == null){
              header("location: ../../admin/index.php");
              session_write_close();
        }
   }
   
   public static function checkLoginClient(){
        $id = CookieClient::getUserId() ;
         if($id == null){
              header("location: ../../index.php");
              session_write_close();
        }
   }
   
    public static function getSubscriberStatus(){
       
             $perm = array(
              array(0,"All","blue"),
              array(1,"Active","green"), 
              array(2,"In Active","red") 
                
              );
    return $perm ;
    }
 }
