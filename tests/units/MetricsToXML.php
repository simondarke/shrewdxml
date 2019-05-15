<?php

namespace SimonDarke\ShrewdXML\tests\units;
use atoum;

require_once 'src/MetricsToXML.php';

class MetricsToXML extends atoum
{

    public function testConstructor()
    {
        $this
            ->given($this->newTestedInstance)
            ->then
            ->string($this->newTestedInstance()->returnXml())
            ->isEqualTo('<?xml version="1.0" encoding="UTF-8"?>
<IndicatorUpdates/>
');
    }

    public function testAddChild()
    {
        $this
            ->and($class = $this->newTestedInstance)
            ->if($class->addChild('AgencyId', 111111))
            ->then
            ->string($class->returnXml())
            ->isEqualTo('<?xml version="1.0" encoding="UTF-8"?>
<IndicatorUpdates><AgencyId>111111</AgencyId></IndicatorUpdates>
');
    }

    public function testAddNode()
    {
        $arrayOfMetrics["calls_handled"]["indicator"] = 21;
        $arrayOfMetrics["calls_handled"]["value"] = 115;
        $arrayOfMetrics["calls_not_handled"]["indicator"] = 22;
        $arrayOfMetrics["calls_not_handled"]["value"] = 12;

        $this
            ->and($class = $this->newTestedInstance)
            ->if($class->addNode('IndUpdate', $arrayOfMetrics))
            ->then
            ->string($class->returnXml())
            ->isEqualTo('<?xml version="1.0" encoding="UTF-8"?>
<IndicatorUpdates><IndUpdate><indicator>21</indicator><value>115</value></IndUpdate><IndUpdate><indicator>22</indicator><value>12</value></IndUpdate></IndicatorUpdates>
');
    }
}