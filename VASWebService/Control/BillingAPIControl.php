<?php

class BillingAPIControl {

    public static function bill($mdn, $billingId, $price, $operatorId, $billtype, $smpp, $billingOption, $msg, $serviceInfo) {

        try {
            $params = array();

            //$mdns = array("249922901223", "249993604848", "249997989418", "249993594690");
            //if (in_array($mdn, $mdns)) {
            $params['gType'] = 1;
            //}
           $params['billingId'] = $billingId;
            $params['price'] = $price;
            $params['msisdn'] = $mdn;
            $params['msg'] = $msg;
            $params['key'] = $serviceInfo['service_key'];
            $params['shortcode'] = $serviceInfo['shortcode'];
            $params['msg'] = $msg;
            $params['serviceInfo'] = $serviceInfo;

            $params['operatorId'] = $operatorId;
            $params['billingType'] = $billtype;
            $params['billingOption'] = $billingOption;
            $params['smpp'] = $smpp;

            json_encode($params, JSON_UNESCAPED_UNICODE);

            $wsPath = General::getConfigurationParameter("billing_api_url", "", General::getConfigurationFile());
            $url = $wsPath . "Request";

            $jsonData = General::callURL($url, json_encode($params, JSON_UNESCAPED_UNICODE));


            General::writeEvent("RES:" . $jsonData);

            $data = json_decode($jsonData);

            return $data;
        } catch (Exception $e) {
            General::writeEvent("sendMessage error:" . $e);
            return null;
        }
    }

    public static function unSubscribe($mdn, $unSubKey,$shortcode) {
        
          try {
            $params = array();

            $mdns = array("249922901223", "249993604848", "249997989418", "249993594690");
            if (in_array($mdn, $mdns)) {
            $params['gType'] = 1;
            }
            $params['shortcode'] = $shortcode;
            $params['unsubKey'] = $unSubKey;
            $params['msisdn'] = $mdn;
             

            $wsPath = General::getConfigurationParameter("billing_api_url", "", General::getConfigurationFile());
            $url = $wsPath . "UnSub";

            $jsonData = General::callURL($url, json_encode($params, JSON_UNESCAPED_UNICODE));


            General::writeEvent("unSubscribe RES:" . $jsonData);

            $data = json_decode($jsonData);

            return $data;
        } catch (Exception $e) {
            General::writeEvent("sendMessage error:" . $e);
            return null;
        }

      
    }

}
