<?php

require './vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';

class MintDOI
{
    /**
     * Store formatted url to pass in CrossRef.
     * @var array
     */
    public $apiLines = array();

    /**
     * Store paper title from EM spreadsheet.
     * @var array
     */
    public $titles = array();

    /**
     * GigaScience as the publisher.
     * @var string
     */
    protected $publisher = "GigaScience";

    /**
     * The default ISSN number for GigaScience.
     * @var string
     */
    protected $ISSN = "2047-217X";

    /**
     * CrossRef API template
     * @var string
     */
    public $crossRefFormat = "https://api.crossref.org/works?query.bibliographic=%s&filter=issn:%s&rows=1";

    /**
     * @param $fileName
     * @return mixed The title of each paper.
     */
    public function getTitle($fileName)
    {
        $xlsx = SimpleXLSX::parse($fileName);

        foreach ($xlsx->rows() as $record)
        {
            if ($record[3] != "Article Title")
            {
                return $record[3];
            }
        }
    }
}