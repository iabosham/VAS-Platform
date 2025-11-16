<?php
	require_once('../../SDPAccess/Common/CookieClient.php'); 
        
        CookieClient::removeCookieClients();
        
        header("location: ../../index.php");

 