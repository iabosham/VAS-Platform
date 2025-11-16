<?php

class XmlParser2{

    public static function parseSubscribeRemove($result){
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><xml/>');
        $xml->addChild('result', $result);
        return $xml->asXML();
    }
    public static function parseMsisdnServices($services){
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><xml/>');

        foreach($services as $service){
            $label = $xml->addChild('service');
            $label->addAttribute('id', $service["service_id"]);
        }

        return $xml->asXML();
    }
    public static function parseServices($services){
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><xml/>');

        foreach($services as $service){
            $label = $xml->addChild('service');
            $label->addAttribute('id', $service["id"]);
            $label->addChild('englishname', $service["en_name"]);
            $label->addChild('arabicname', $service["name"]);
        }

        return $xml->asXML();
    }

}