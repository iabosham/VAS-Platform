<?php
	require_once('../../Common/Cookie.php'); 
        
        Cookie::removeCookies();
        
        header("location: ../../index.php");

 