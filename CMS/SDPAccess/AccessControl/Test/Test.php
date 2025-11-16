<?php

 require_once '../../Common/General.php';
 require_once '../../Model/DBConnection.php';
 require_once '../../Model/Message.php';
 require_once '../../AccessControl/Message/MessageControl.php';
 
 $data = MessageControl::checkIsMessageExistByDate("روك باي بيبي", "2016-12-17 00:20:53", 99); 
 
 print_r($data);
 
 
 
 
    
 