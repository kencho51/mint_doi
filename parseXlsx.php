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
        $record[3] = str_replace(array("\n", "\r"), '', $record[3]);
        $record[3] = strtolower($record[3]);
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

//print_r($titles);
//print(count($apiLines)); //Total records = 702.
//var_dump($apiLines);

for ($i = 0; $i < count($apiLines); $i++)
{
    $data = file_get_contents($apiLines[$i]);
    $apiResults = json_decode($data, true);

//    $fp = fopen($fileToMint.'-'.date('Y-m-d').'.'.'minted.csv', 'a');
    if ($apiResults['status'] === 'ok') {
        foreach ($apiResults['message']['items'] as $result) {
            print($result['title'][0])."\n";
//            if (in_array(strtolower($result['title'][0]), $titles)){
////                print($result['title'][0])."\n";
////                print($result['title'][0].' '.$result['DOI'].' '. $apiResults['status']."\n");
////                $fields = array(
////                    'CrossRef API Status' => $apiResults['status'],
////                    'URL' => $result['URL'],
////                    'Title' => $result['title'][0]
////                );
////                fputcsv($fp, $fields);
//            } else {
////                print($result['title'][0])."\n";
////                print($titles[$i]);
////                print ($titles[$i].' '."This article is not found in CrossRef!!!"."\n");
////                $fields = array(
////                    'CrossRef API Status' => $apiResults['status'],
////                    'URL' => 'The doi is not found in CrossRef!',
////                    'Title' => $result['title'][0]
////                );
////                fputcsv($fp, $fields);
//            }
        }
    } else {
//        print ("CrossRef return status is fail!");
        $fields = array(
            'CrossRef API Status' => 'CrossRef API return status is not OK!',
            'URL' => 'NA',
            'Title' => $apiResults['message']['items']['title'][0]
        );
    }
//    fclose($fp);
}



