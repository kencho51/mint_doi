<?php

require 'vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';

//$xlsx = SimpleXLSX::parse('report.xlsx');

$f = fopen('php://stdin', 'r');
$xlsx = new SimpleXLSX($f);
fclose($f);



$apiLines = array();
$titles = array();

$publisher = "GigaScience";
$ISSN = "2047-217X";
$crossRefFormat = "https://api.crossref.org/works?query.bibliographic=%s&filter=issn:%s&rows=1";

foreach ($xlsx->rows() as $record)
{
    //Extract only title, first author last name and first name
    if ($record[3] != "Article Title")
    {
        if (!in_array($record[3], $titles, true)) {
            array_push($titles, $record[3]);
        }
//        print($record[3]."\n"); //Total records = 829.
        $desiredRecord = sprintf($crossRefFormat, $record[3], $ISSN."\n");
        $apiURL = str_replace(' ', '%20', $desiredRecord);
        $apiURL = str_replace(array("\n", "\r"), '', $apiURL);
        if (!in_array($apiURL, $apiLines, true)) { //Remove duplicate lines
            array_push($apiLines, $apiURL);
        }
    }
}

//print(count($titles));
//print(count($apiLines)); //Total records = 702.

for ($i = 0; $i < count($apiLines); $i++)
{
    $data = file_get_contents($apiLines[$i]);
    $apiResults = json_decode($data, true);

    if ($apiResults['status'] === 'ok') {
        foreach ($apiResults['message']['items'] as $result) {
            if (in_array($result['title'][0], $titles, true)){
                print($result['title'][0].' '.$result['DOI'].' '. $apiResults['status']."\n");
            } else {
                print ($titles[$i].' '."This article is not found in CrossRef!!!"."\n");
            }
        }
    } else {
        print ("CrossRef return status is fail!");
    }
}



