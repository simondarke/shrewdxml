<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
use SimonDarke\ShrewdXML\MetricsToXML;
use SimonDarke\ShrewdXML\Curl;

$agencyId = 111111;
$accessToken = 22222222222222222;
$endpoint = 'https://staging-t3.e-shrewd.com/ShrewdWSV4/indUpdateV2/add/';

$arrayOfMetrics["calls_handled"]["indicator"] = 21;
$arrayOfMetrics["calls_handled"]["value"] = 20;
$arrayOfMetrics["calls_not_handled"]["indicator"] = 22;
$arrayOfMetrics["calls_not_handled"]["value"] = 12;

$feedXML = new MetricsToXML();


$feedXML->addChild('AgencyId', $agencyId);
$feedXML->addChild('AccessToken', $accessToken);
$feedXML->addNode('IndUpdate', $arrayOfMetrics);

$payload = new Curl($endpoint, $feedXML->returnXml());

if (!$payload->sendPayload()) {
    echo "failed to send";
        foreach($payload as $error) {
            echo $error."<br>";
        }
} else {
    echo "Sent indicators\n";
}
