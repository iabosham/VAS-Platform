<?php

$username = getCleanData(INPUT_GET, 'username', FILTER_SANITIZE_STRING);
$password = getCleanData(INPUT_GET, 'password', FILTER_SANITIZE_STRING);

$result = Model::all("operators", [
    ["username", "=", $username],
    ["password", "=", md5($password)],
]);

 

if(count($result)){
    $auth_operator = $result[0];
    Session::put("auth_operator", $auth_operator);
} else {
     XmlParser2::parseSubscribeRemove(3);
   exit;
}
