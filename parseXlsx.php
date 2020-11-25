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
        $apiURL = str_replace(array("\n", "\r"), '', $apiURL);
//        print($apiURL)."\n"; //830
        if (!in_array($apiURL, $apiLines, true)) { //Remove duplicate lines
            array_push($apiLines, $apiURL);
        }
    }
}

for ($i = 0; $i < count($apiLines); $i++)
{
    print $apiLines[$i]."\n"; //702
//    $data = file_get_contents($apiLines[$i]);
//    $apiResults = json_decode($data, true);
//    foreach ($apiResults as $result) {
//        if (is_array($result['items']) || is_object($result['items'])) {
//            foreach ($result['items'] as $item) {
//                print($item['title'][0].' '.$item['DOI']."\n");
//            }
//        }
//    }
}



