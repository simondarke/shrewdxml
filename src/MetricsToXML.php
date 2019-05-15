<?php

namespace SimonDarke\ShrewdXML;

class MetricsToXML
{
    protected $agencyId;
    protected $accessToken;
    protected $xmlObject;

    public function __construct()
    {
        $this->xmlObject = new \SimpleXMLElement($this->generateHeader());
    }

    public function returnXml()
    {
        return $this->xmlObject->asXML();
    }

    protected function generateHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?><IndicatorUpdates></IndicatorUpdates>';
    }

    public function addNode($nodeName, array $metrics)
    {
        //TODO add some logging here of whats getting set. Maybe monolog or something like that.
        foreach ($metrics as $metric) {
            $node = $this->xmlObject->addChild($nodeName);
            foreach ($metric as $dataKey => $value) {
                $node->addChild($dataKey, $value);
            }
        }
    }

    public function addChild($childName, $childValue)
    {
        $this->xmlObject->addChild($childName, $childValue);
    }
}
