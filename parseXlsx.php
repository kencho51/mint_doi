<?php

require 'vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';

$xlsx = SimpleXLSX::parse('report.xlsx');

$apiLines = array();

$publisher = "GigaScience";
$crossRefFormat = "https://api.crossref.org/works?query.bibliographic=%s&query.author=%s %s&query.container-title=%s";

foreach ($xlsx->rows() as $record)
{
    //Extract only title, first author last name and first name
    if ($record[3] != "Article Title" && $record[4] !="Corresponding Author Last Name" && $record[5] !="Corresponding Author First Name")
    {
        $desiredRecord = sprintf($crossRefFormat, $record[3], $record[5], $record[4], $publisher."\n");
        $apiURL = str_replace(' ', '%20', $desiredRecord);
//        $apiURL = rawurlencode($desiredRecord);
        array_push($apiLines, $apiURL);
    }

}

//for ($i = 0; $i < count($apiLines); $i++)
//{
//    print $apiLines[$i];
//}

//$url = "https://api.crossref.org/works?query.bibliographic=Mitochondrial%20Metagenomics:%20Letting%20the%20Genes%20out%20of%20the%20Bottle&query=Alfried%20Vogler&query.container-title=GigaScience";
//$data = file_get_contents($url);
//$results = json_decode($data, true);

$testArr = Array (
    0 => "https://api.crossref.org/works?query.bibliographic=Mitochondrial%20Metagenomics:%20Letting%20the%20Genes%20out%20of%20the%20Bottle&query=Alfried%20Vogler&query.container-title=GigaScience",
    1 => "https://api.crossref.org/works?query.bibliographic=Fractal%20Self-similarity,%20Scale%20Invariance%20and%20Stationary%20waves%20Codes%20Architecture%20Human%20Chromosomes%20DNA%20sequences&query.author=Jean%20Perez&query.container-title=GigaScience",
    2 => "https://api.crossref.org/works?query.bibliographic=Fish-T1K:%20A%20Proposal%20to%20Obtain%20Transcriptome%20Sequences%20for%201,000%20Fish%20Species&query.author=Qiong%20Shi&query.container-title=GigaScience",
);


for ($i = 0; $i < count($testArr); $i++)
{
    $data = file_get_contents($testArr[$i]);
    $apiResults = json_decode($data, true);
    foreach ($apiResults as $result) {
        foreach ($result['items'] as $test) {
            print($test['title'][0].' '.$test['DOI']."\n");
        }
    }
}


//
//foreach ($results as $result) {
//    foreach ($result['items'] as $test) {
//        print($test['title'][0].' '.$test['DOI']);
//    };
//}
