<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
use SimonDarke\ShrewdXML\MetricsToXML;

$agencyId = 111111;
$accessToken = 22222222222222222;

$arrayOfMetrics["calls_handled"]["indicator"] = 21;
$arrayOfMetrics["calls_handled"]["value"] = 115;
$arrayOfMetrics["calls_not_handled"]["indicator"] = 22;
$arrayOfMetrics["calls_not_handled"]["value"] = 12;

$feedXML = new MetricsToXML();
echo $feedXML->returnXml();

$feedXML->addChild('AgencyId', $agencyId);
//$feedXML->addChild('AccessToken', $accessToken);
$feedXML->addNode('IndUpdate', $arrayOfMetrics);

echo $feedXML->returnXml();