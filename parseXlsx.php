<?php

require 'vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';

$xlsx = SimpleXLSX::parse('report.xlsx');

$apiLines = array();

$publisher = "GigaScience";
$ISSN = "2047-217X";
$crossRefFormat = "https://api.crossref.org/works?query.bibliographic=%s&query.author=%s %s&filter=issn:%s&rows=1";

foreach ($xlsx->rows() as $record)
{

    //Extract only title, first author last name and first name
    if ($record[3] != "Article Title" && $record[4] !="Corresponding Author Last Name" && $record[5] !="Corresponding Author First Name")
    {
        $desiredRecord = sprintf($crossRefFormat, $record[3], $record[5], $record[4], $ISSN."\n");
        $apiURL = str_replace(' ', '%20', $desiredRecord);
//        $apiURL = rawurlencode($desiredRecord);
        array_push($apiLines, $apiURL);
    }

}

//
for ($i = 700; $i < count(array_unique($apiLines)); $i++)
{
//    print $apiLines[$i];
    $data = file_get_contents($apiLines[$i]);
    $apiResults = json_decode($data, true);
    foreach ($apiResults as $result) {
        if (is_array($result['items']) || is_object($result['items'])) {
            foreach ($result['items'] as $item) {
                print($item['title'][0].' '.$item['DOI']."\n");
            }
        }
    }
}


/**
 * Below script is for testing
 */

//$testArr = Array (
//    0 => "https://api.crossref.org/works?query.bibliographic=Mitochondrial%20Metagenomics:%20Letting%20the%20Genes%20out%20of%20the%20Bottle&query.author=Alfried%20Vogler&query.container-title=GigaScience&rows=1",
//    1 => "https://api.crossref.org/works?query.bibliographic=Bioboxes%20-%20standardised%20containers%20for%20interchangeable%20bioinformatics%20software&query.author=Michael%20Barton&query.container-title=GigaScience&rows=1",
//    2 => "https://api.crossref.org/works?query.bibliographic=Clusterflock:%20A%20Flocking%20Algorithm%20for%20Isolating%20Congruent%20Phylogenomic%20Datasets&query.author=Paul%20Planet&query.container-title=GigaScience&rows=1",
//);
//
//
//for ($i = 0; $i < count($testArr); $i++)
//{
//    $data = file_get_contents($testArr[$i]);
//    $apiResults = json_decode($data, true);
//
//    foreach ($apiResults as $result) {
////        print_r($result['items']);
//        if (is_array($result['items']) || is_object($result['items'])) {
//            foreach ($result['items'] as $test) {
//                print($test['title'][0].' '.$test['DOI']."\n");
//            }
//        }
//    }
//}


