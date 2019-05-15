<?php

namespace SimonDarke\ShrewdXML;

class MetricsToXML
{
    protected $agencyId;
    protected $accessToken;
    protected $xmlObject;

    public function __construct($agencyId, $accessToken)
    {
        $this->xmlObject = new \SimpleXMLElement($this->generateHeader());

        $this->setAccessToken($accessToken);
        $this->setAgencyId($agencyId);

        $this->addChild('AgencyId', $this->agencyId);
        $this->addChild('AccessToken', $this->accessToken);

    }

    public function getAgencyId()
    {
        return $this->accessToken;
    }

    public function setAgencyId($agencyId)
    {
        $this->agencyId = $agencyId;
        return $this->agencyId;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this->accessToken;
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

    protected function addChild($childName, $childValue)
    {
        $this->xmlObject->addChild($childName, $childValue);
    }
}
