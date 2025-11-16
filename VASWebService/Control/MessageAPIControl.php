<?php

class MessageAPIControl {

    public static function sendMessage($mdn, $msg, $serviceId) {

        try {
            $params = array();
            $params['username'] = General::getConfigurationParameter("sms_api_username", "ivr", General::getConfigurationFile());
            $params['password'] = General::getConfigurationParameter("sms_api_password", "ivr", General::getConfigurationFile());
            $params['serviceId'] = $serviceId ;
            $params['MSG'] = $msg ;
            $params['mobileNo'] = $mdn;
            $params['sourceType'] = 1;

            $wsPath = General::getConfigurationParameter("sms_api_url", "",General::getConfigurationFile());
            $url = $wsPath . "PostMessage/";
            
            $jsonData = General::callURL($url, json_encode($params,JSON_UNESCAPED_UNICODE));
   
            $data = json_decode($jsonData);

            return $data;
        } catch (Exception $e) {
            General::writeEvent("sendMessage error:" . $e);
            return null;
        }
    }

}
