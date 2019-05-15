<?php

namespace SimonDarke\ShrewdXML\tests\units;
use atoum;

require_once 'src/ResponseParser.php';

class ResponseParser extends atoum
{
    public function testSuccessResponse()
    {
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?><messages><msg type="success">Updated successfully</msg></messages>
XML;
        $this
            ->given($this->newTestedInstance)
            ->then
            ->boolean($this->newTestedInstance()->checkResponse($xml))
            ->isEqualTo(true);
    }

    public function testFailedResponse()
    {

        $class = $this->newTestedInstance;
        $this->exception(
            function() use ($class) {
                $xml = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?><messages><msg type="error">Not Updated successfully</msg></messages>
XML;
                $class->checkResponse($xml);
            })->isIdenticalTo($this->exception);
    }

}