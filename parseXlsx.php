<?php

require 'vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';

$fileToMint = $_SERVER['argv'][1]; //Input file in command line
$xlsx = SimpleXLSX::parse($fileToMint);

$apiLines = array();
$titles = array();

$publisher = "GigaScience";
$ISSN = "2047-217X";
$crossRefFormat = "https://api.crossref.org/works?query.bibliographic=%s&filter=issn:%s&rows=1";

foreach ($xlsx->rows() as $record)
{
    //Extract only title
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

$doiUrl = "https://doi.org/";
for ($i = 0; $i < count($apiLines); $i++)
{
    $data = file_get_contents($apiLines[$i]);
    $apiResults = json_decode($data, true);

    $fp = fopen($fileToMint.'-minted.csv', 'a');
    if ($apiResults['status'] === 'ok') {
        foreach ($apiResults['message']['items'] as $result) {
            if (in_array($result['title'][0], $titles, true)){
//                print($result['title'][0].' '.$result['DOI'].' '. $apiResults['status']."\n");
                $fields = array(
                    'Status' => $apiResults['status'],
                    'DOI' => $doiUrl.$result['DOI'],
                    'Title' => $result['title'][0]
                );
                fputcsv($fp, $fields);
            } else {
//                print ($titles[$i].' '."This article is not found in CrossRef!!!"."\n");
                $fields = array(
                    'Status' => $apiResults['status'],
                    'DOI' => 'The doi is not found in CrossRef!',
                    'Title' => $result['title'][0]
                );
                fputcsv($fp, $fields);
            }
        }
    } else {
//        print ("CrossRef return status is fail!");
        $fields = array(
            'Status' => 'CrossRef return status is not OK!',
            'DOI' => 'NA',
            'Title' => $apiResults['message']['items']['title'][0]
        );
    }
    fclose($fp);
}



