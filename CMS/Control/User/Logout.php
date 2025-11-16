<?php
	require_once('../../SDPAccess/Common/CookieCMS.php'); 
        
        Cookie::removeCookies();
        
        header("location: ../../admin/index.php");

 