<?php

header('Content-Type: text/json; charset=utf-8');

require_once '../Include/Requirement.php';
$accessPath = Code::getSDPAccessPath();
require_once $accessPath . '/Common/General.php';

require_once $accessPath . '/Model/DBConnection.php';


require_once $accessPath . '/Model/Client.php';
require_once $accessPath . '/Model/Service.php';
require_once $accessPath . '/Model/Shortcode.php';
require_once $accessPath . '/Model/Inbox.php';

require_once $accessPath . '/AccessControl/Client/ClientControl.php';
require_once $accessPath . '/AccessControl/Service/ServiceControl.php';

$data = array();
if (Code::checkLogin()) {
  $dataSource = new ServiceControl();

  try {
    $services = $dataSource->getAllServices();
    $res = [];
    $msg = "successful operation";
    $success = true;
    if ($services != null) {
      $res = $services;
    }
    $data['result'] =  0;
    $data['msg'] =  $msg;
    $data['success'] = $success;
    $data['data'] = $res;
  } catch (Exception $e) {
    $data['result'] =  10;
    $data['msg'] =  "System error";
    $data['success'] = false;
    $data['data'] = [];
  }
} else {
  http_response_code(403);
  $data['result'] =  5;
  $data['msg'] =  "Authentication error";
  $data['success'] = false;
  $data['data'] = [];
}
$json = (json_encode($data, JSON_UNESCAPED_UNICODE));
print_r($json);
