<?php

require 'vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';

$fileToMint = $_SERVER['argv'][1]; //Input file in command line
$xlsx = SimpleXLSX::parse($fileToMint);

$apiLines = array();
$titles = array();
$titles_lower = array();

$publisher = "GigaScience";
$ISSN = "2047-217X";
$crossRefFormat = "https://api.crossref.org/works?query.bibliographic=%s&filter=issn:%s&rows=1";

foreach ($xlsx->rows() as $record)
{
    //Extract only title
    if ($record[3] != "Article Title")
    {
        $normalizedTitle = $record[3];
        $normalizedTitle = str_replace(["\r","\n","\r\n","\t","\v","\0"], "", $normalizedTitle);
        $normalizedTitleLower = strtolower($normalizedTitle);
        if (!in_array($normalizedTitle, $titles, true)) {
//            $titles = str_replace(["\n","\r"], "", $titles);
            array_push($titles, $normalizedTitle);
            array_push($titles_lower, $normalizedTitleLower);
        }
//        print($record[3]."\n"); //Total records = 829.
        $desiredRecord = "https://api.crossref.org/works?query.bibliographic=".$record[3]."&filter=issn:".$ISSN."&rows=1";
//        print($desiredRecord);
        $apiURL = str_replace(' ', '%20', $desiredRecord);
//        print($apiURL);
        if (!in_array($apiURL, $apiLines, true)) { //Remove duplicate lines
            array_push($apiLines, "$apiURL");
        }
    }
}

//print_r($titles);
//print(count($apiLines)); //Total records = 702.
//print_r($apiLines);

$fp = fopen($fileToMint.'-'.date('Y-m-d').'.'.'minted.csv', 'a');
$fields = array(
    'Input Title' => 'Input Title from EM',
    'CrossRef API Status' => 'CrossRef API Status',
    'CrossRef Title' => 'CrossRef Title',
    'CrossRef URL' => 'DOI URL',
);
fputcsv($fp, $fields);

for ($i = 0; $i < count($apiLines); $i++)
{
//    print($apiLines[$i]);
    $data = file_get_contents($apiLines[$i]);
    $apiResults = json_decode($data, true);

    if ($apiResults['status'] === 'ok') {
        foreach ($apiResults['message']['items'] as $result) {
            $normalizedReturnTitle = $result['title'][0];
            $normalizedReturnTitle = str_replace(["\r","\n","\r\n","\t","\v","\0"], "", $normalizedReturnTitle);
            $normalizedReturnTitle = strtolower($normalizedReturnTitle);
            if (in_array($normalizedReturnTitle, $titles_lower)){
//                print($result['title'][0].' '.$titles[$i])."\n";
//                print($result['title'][0].' '.$result['DOI'].' '. $apiResults['status']."\n");
                $fields = array(
                    'Input Title' => $titles[$i],
                    'CrossRef API Status' =>  $apiResults['status'],
                    'CrossRef Title' => $result['title'][0],
                    'CrossRef URL' => $result['URL'],
                );
                fputcsv($fp, $fields);
            } else {
//                print($normalizedReturnTitle)."\n";
//                print($titles[$i]);
//                print ($titles[$i].' '."This article is not found in CrossRef!!!"."\n");
                $fields = array(
                    'Input Title' => $titles[$i],
                    'CrossRef API Status' =>  $apiResults['status'],
                    'CrossRef Title' => $result['title'][0],
                    'CrossRef URL' => $result['URL'],
                );
                fputcsv($fp, $fields);
            }
        }
    } else {
//        print ("CrossRef return status is fail!");
        $fields = array(
            'CrossRef API Status' => 'CrossRef API return status is not OK!',
            'URL' => 'NA',
            'Title' => $apiResults['message']['items']['title'][0]
        );
    }

}

fclose($fp);


