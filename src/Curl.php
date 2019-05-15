<?php

namespace SimonDarke\ShrewdXML;

class Curl
{
    /**
     * @var
     */
    protected $endpoint;
    /**
     * @var
     */
    protected $payload;
    /**
     * @var
     */
    protected $curlOpts;

    /**
     * Curl constructor.
     *
     * @param $endpoint
     * @param $payload
     */
    public function __construct($endpoint, $payload)
    {
        $this->setEndpoint($endpoint);
        $this->setPayload($payload);
        $this->setcurlOpts();
    }

    /**
     * @param $endpoint
     *
     * @return mixed
     */
    protected function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this->endpoint;
    }

    /**
     * @param $payload
     *
     * @return mixed
     */
    protected function setPayload($payload)
    {
        $this->payload = $payload;
        return $this->payload;
    }

    /**
     *
     */
    protected function setCurlOpts()
    {
        $this->curlOpts = array(
            CURLOPT_URL            => $this->endpoint,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER => array("Content-Type: text/xml"),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => $this->payload
        );
    }

    /**
     * @return bool|string
     */
    public function sendPayload()
    {
        $handler = curl_init();
        curl_setopt_array($this->curlOpts);
        $rp = new ResponseParser;
        try{
            $rp->checkRepsonse(curl_exec($handler));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return true;
    }
}