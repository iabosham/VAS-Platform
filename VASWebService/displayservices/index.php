<?php

header('Content-Type: text/json; charset=utf-8');

require_once '../Include/Requirement.php';
$accessPath = Code::getSDPAccessPath();
require_once $accessPath . '/Common/General.php';

require_once $accessPath . '/Model/DBConnection.php';


require_once $accessPath . '/Model/Subscriber.php';

require_once $accessPath . '/AccessControl/Subscriber/SubscriberControl.php';

$dataSource = new SubscriberControl();


$data = array();
if (Code::checkLogin()) {
  try {
    $msisdn = General::cleanGet("mdn");
    if ($msisdn != null) {
      if (preg_match("/^1[0-9]{8}$/", $msisdn)) {
        $msisdn = '249' . $msisdn;
        $services = $dataSource->getServicesOfSubscriber($msisdn);
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
      } else {
        $data['result'] =  4;
        $data['msg'] =  "mdn not valid (ex 120120120)";
        $data['success'] = false;
        $data['data'] = [];
      }
    } else {
      $data['result'] =  4;
      $data['msg'] =  "mdn required";
      $data['success'] = false;
      $data['data'] = [];
    }
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
