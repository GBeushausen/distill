<?php

namespace Distill\Tests\Format;

use Distill\Format\Gz;

class GzTest extends AbstractFormatTest
{

    public function setUp()
    {
        $this->format = new Gz();
    }

    public function testCompressionRatioLevelIsValid()
    {
        $this->assertLevelValid($this->format->getCompressionRatioLevel());
    }

    public function testCompressionSpeedLevelIsValid()
    {
        $this->assertLevelValid($this->format->getCompressionSpeedLevel());
    }

    public function testUncompressionSpeedLevelIsValid()
    {
        $this->assertLevelValid($this->format->getUncompressionSpeedLevel());
    }

}