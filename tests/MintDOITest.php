<?php

use PHPUnit\Framework\TestCase;

class MintDOITest extends TestCase
{
    public function testPHPUnitIsWorking()
    {
        $mintDOI = new MintDOI;

        $this->assertEquals(4, 2 + 2);
    }

}