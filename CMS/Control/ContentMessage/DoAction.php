<?php
//Start session
session_start();
require_once('../../Control/Include/PublicRequirement.php');
require_once('../../SDPAccess/Model/ContentMessage.php');
require_once('../../SDPAccess/AccessControl/ContentMessage/ContentMessageControl.php');

//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;

//POST values
 $ids = $_POST['ids'];
  
 if($ids != null){
 
      print_r($ids);
     
 }else {
    General::addError("check messages first");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/ContentMessage/content_message.php");
    exit();
      
 }
 
 $sucessFlag = false ;
  if(isset($_POST['approve'])){
      
      foreach($ids as $id){
          
         $success =  ContentMessageControl::updateApprovalStatus($id, 0, Cookie::getUserId());   
         if($success){
            $sucessFlag = true;
         }
          
      }
     
 }
 
   if(isset($_POST['not_approve'])){
      
      foreach($ids as $id){
          
         $success =  ContentMessageControl::updateApprovalStatus($id, 1, Cookie::getUserId());  
         if($success){
            $sucessFlag = true;
         }
          
      }
     
 }
 
    if(isset($_POST['reject'])){
      
      foreach($ids as $id){
          
         $success =  ContentMessageControl::updateContentStatus($id, 2, Cookie::getUserId());   
         if($success){
            $sucessFlag = true;
         }
          
      }
     
 }
 
 
  if(isset($_POST['un_reject'])){
      
      foreach($ids as $id){
          
         $success =  ContentMessageControl::updateContentStatus($id, 0, Cookie::getUserId());   
         if($success){
            $sucessFlag = true;
         }
          
      }
     
 }
 
  if(isset($_POST['delete'])){
      
      foreach($ids as $id){
          
         $success =  ContentMessageControl::deleteContentMessage($id);   
         if($success){
            $sucessFlag = true;
         }
          
      }
     
 }
 
 
 
 

 if($sucessFlag){
    Session::setSessionValue(Session::$SUCCESS_OPERATION,"Action has been done successfully")  ;
    session_write_close();
    header("location: ../../View/ContentMessage/content_message.php");
    exit();
}else {
    General::addError("No changes ...");
    Session::setSessionValue(Session::$ENVALED_OPERATION, General::getError())  ;
    session_write_close();
    header("location: ../../View/ContentMessage/content_message.php");
    exit();
   
}
 