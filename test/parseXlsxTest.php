<?php
/**
 * Below script is for testing
 */

$title = Array (
    0 => "Mitochondrial metagenomics: letting the genes out of the bottle",
    1 => "Bioboxes: standardised containers for interchangeable bioinformatics software",
    2 => "Clusterflock: a flocking algorithm for isolating congruent phylogenomic datasets",
    3 => "Fractal Self-similarity, Scale Invariance and Stationary waves Codes Architecture Human Chromosomes DNA",
    4 => "Mitochondrial metagenomics: letting the genes out of the bottle",
);

$testArr = Array (
    0 => "https://api.crossref.org/works?query.bibliographic=Mitochondrial%20Metagenomics:%20Letting%20the%20Genes%20out%20of%20the%20Bottle&filter=issn:2047-217X&rows=1",
    1 => "https://api.crossref.org/works?query.bibliographic=Bioboxes%20-%20standardised%20containers%20for%20interchangeable%20bioinformatics%20software&filter=issn:2047-217X&rows=1",
    2 => "https://api.crossref.org/works?query.bibliographic=Clusterflock:%20A%20Flocking%20Algorithm%20for%20Isolating%20Congruent%20Phylogenomic%20Datasets&filter=issn:2047-217X&rows=1",
    3 => "https://api.crossref.org/works?query.bibliographic=Fractal%20Self-similarity,%20Scale%20Invariance%20and%20Stationary%20waves%20Codes%20Architecture%20Human%20Chromosomes%20DNA%20sequences&filter=issn:2047-217X&rows=1",
    4 => "https://api.crossref.org/works?query.bibliographic=Mitochondrial%20Metagenomics:%20Letting%20the%20Genes%20out%20of%20the%20Bottle&filter=issn:2047-217X&rows=1",
);


for ($i = 0; $i < count($testArr); $i++)
{
    $data = file_get_contents($testArr[$i]);
    $apiResults = json_decode($data, true);

    if ($apiResults['status'] === 'ok') {
        foreach ($apiResults['message']['items'] as $result) {
//            print_r($result['title']);
//            print($result['title'][0]);
            if (in_array($result['title'][0], $title, true)) {
                print ($result['title'][0].' '.$result['DOI'].' '.$apiResults['status']."\n");
                print ("--------------"."\n");
            } else {
                print ($title[$i].' '."This article is not found in CrossRef!!!"."\n");
                print ("The top hit found is:".' '.$result['title'][0].' '.$result['DOI'].' '."\n");
                print ("--------------"."\n");
            }
        }
    } else {
        print ("CrossRef return status is fail");
        print ("--------------"."\n");
    }
}
