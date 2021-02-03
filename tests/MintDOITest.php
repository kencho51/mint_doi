<?php

use PHPUnit\Framework\TestCase;

class MintDOITest extends TestCase
{
    protected $mintDOI;

    public function setUp(): void
    {
        $this->mintDOI = new MintDOI;
    }

    public function testTitleIsEmptyByDefault()
    {
        $this->assertEmpty($this->mintDOI->title);
    }

    public function testGetEMTitleWithNoTitle()
    {
        $this->assertSame($this->mintDOI->getEMTitle(), "");
    }

    public function testGetEMTitleFromArray()
    {
        $EM = array(
            0 => "Manuscript Number",
            1 => "Initial Date Submitted",
            2 => "Editorial Status",
            3 => "Article Title",
            4 => "Corresponding Author Last Name",
            5 => "Corresponding Author First Name",
            6 => "E-mail Address",
            7 => "First Author Last Name",
            8 => "First Author First Name",
            9 => "Manuscript Notes",
            10 => "Final Disposition Term",
            11 => "Publication Date",
            12 => "All Authors",
            13 => "Corresponding Author ORCID",
            14 => "Funder Name",
            15 => "Grant Number",
            16 => "Grant Recipient",
            17 => "Abstract",
        );



    }
}