<?php

class ServiceController
{

    public static function all()
    {
        $auth_operator = Session::get("auth_operator");
        return Model::executeSql("SELECT service.* FROM `service` INNER JOIN shortcode ON shortcode.id = service.shortcode_id WHERE shortcode.company_id = " . $auth_operator["id"]);
    }

    public static function servicesByMsisdn($msisdn)
    {
        $sql = "SELECT service_id FROM `service_subscription` WHERE msisdn = $msisdn";
        $result = Model::executeSql($sql);
        if ($result) {
            return $result;
        } else {
            return [];
        }
    }
    public static function removeAll($msisdn)
    {
        if (!preg_match("/^1[0-9]{8}$/", $msisdn)) {
            return 6;
        }
        $msisdn = '249' . $msisdn;
        
        $subs = Model::all("service_subscription", [
            ["msisdn", "=", $msisdn]
        ]);
        $result = Model::deleteData("service_subscription", [
            ["msisdn", "=", $msisdn],
        ]);
        if ($result) {
            $count = 0;
            $service_count = count($subs);
            foreach ($subs as $value) {
                Model::saveData("unsubscribes", [
                    "msisdn" => $msisdn,
                    "service_id" => $value["service_id"],
                    "unsub_type" => "api",
                    "subscription_date" => $value["subscription_date"],
                    "subscription_channel" => $value["subscription_channel"]
                ]);
                $count++;
            }
            if ($service_count == 0) {
                return 5;
            }
            if ($count == $service_count) {
                return 0;
            }
            
        } else {
            return 10;
        }
    }
    public static function remove($msisdn, $serviceId)
    {
        if (!$serviceId || !$msisdn) {
            return 4;
        }
        $service = self::checkServiceByCode($serviceId);
        if (!$service) {
            return 5;
        }
        if (!preg_match("/^1[0-9]{8}$/", $msisdn)) {
            return 6;
        }
        $msisdn = '249' . $msisdn;
        $serviceId = $service["id"];
        $subscriberId = self::getSubscriberId($msisdn);
        $check = self::checkSubscription($msisdn, $serviceId);
        if ($check) {

            $result = Model::deleteData("service_subscription", [
                // ["subscriber_id", "=", $subscriberId],
                ["service_id", "=", $serviceId],
                ["msisdn", "=", $msisdn],
            ]);
            if ($result) {
                Model::saveData("unsubscribes", [
                    "msisdn" => $msisdn,
                    "service_id" => $serviceId,
                    "unsub_type" => "api",
                    "subscription_date" => $check["subscription_date"],
                    "subscription_channel" => $check["subscription_channel"]
                ]);
                return 0;
            } else {
                return 10;
            }
        } else {
            return 2;
        }
    }
    private static function checkSubscription($msisdn, $serviceId)
    {
        $check = Model::all("service_subscription", [
            // ["subscriber_id", "=", $subscriberId],
            ["service_id", "=", $serviceId],
            ["msisdn", "=", $msisdn],
        ]);
        return $check[0];
    }
    private static function checkServiceByCode($code)
    {

        $result = Model::all("service", [
            ["service_code", "=", $code],
        ]);
        return $result[0];
    }
    public static function subscribe($msisdn, $serviceId)
    {
        if (!$serviceId || !$msisdn) {
            return 4;
        }
        $service = self::checkServiceByCode($serviceId);
        if (!$service) {
            return 5;
        }
        if (!preg_match("/^1[0-9]{8}$/", $msisdn)) {
            return 6;
        }
        $msisdn = '249' . $msisdn;
        $serviceId = $service["id"];
        $subscriberId = self::getSubscriberId($msisdn);
        $check = self::checkSubscription($msisdn, $serviceId);
        if ($check) {
            return 1;
        } else {
            $result = Model::saveData("service_subscription", [
                "subscriber_id" => $subscriberId,
                "service_id" => $serviceId,
                "msisdn" => $msisdn,
                "subscription_date" => date("Y-m-d H:i:s"),
                "subscription_channel" => "api",
                "subscription_date_number" => time(),
                "isActive" => 0,
                "order_id" => 0
            ]);
            if ($result) {
                return 0;
            } else {
                return 10;
            }
        }
    }

    private static function getSubscriberId($msisdn)
    {
        $result = Model::all("subscriber", [["msisdn", "=", $msisdn]]);
        if (count($result)) {
            return $result[0]["id"];
        } else {
            $auth_operator = Session::get("auth_operator");

            $savedId = Model::saveData("subscriber", [
                "msisdn" => $msisdn,
                "isActive" => 1,
                "operator_id" => $auth_operator["id"]
            ]);
            return $savedId;
        }
    }
}