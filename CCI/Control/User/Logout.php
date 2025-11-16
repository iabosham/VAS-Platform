<?php
	require_once('../../SDPAccess/Common/Cookie.php'); 
        
        Cookie::removeCookies();
        
        header("location: ../../index.php");

 