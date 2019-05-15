<?php

namespace SimonDarke\ShrewdXML;

/**
 * Class ResponseParser
 *
 * @package SimonDarke\ShrewdXML
 */
class ResponseParser
{

    /**
     * @param $response
     *
     * @return bool
     * @throws \Exception
     */
    public function checkResponse($response)
    {
        libxml_use_internal_errors(true);
        $parsedResponse = new \SimpleXMLElement($response);
        if($parsedResponse !== false) {
            foreach ($parsedResponse as $message) {
                if ($message['type'] != 'success') {
                    Throw New \Exception($message);
                }
            }
            return true;
        } else {
            $errors = libxml_get_errors();
            foreach ($errors as $error) {
                Throw New \Exception($error);
            }
        }
        return true;
    }
}
