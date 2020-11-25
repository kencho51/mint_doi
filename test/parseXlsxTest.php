<?php
/**
 * Below script is for testing
 */

$testArr = Array (
    0 => "https://api.crossref.org/works?query.bibliographic=Mitochondrial%20Metagenomics:%20Letting%20the%20Genes%20out%20of%20the%20Bottle&query.author=Alfried%20Vogler&filter=issn:2047-217X&rows=1",
    1 => "https://api.crossref.org/works?query.bibliographic=Bioboxes%20-%20standardised%20containers%20for%20interchangeable%20bioinformatics%20software&query.author=Michael%20Barton&filter=issn:2047-217X&rows=1",
    2 => "https://api.crossref.org/works?query.bibliographic=Clusterflock:%20A%20Flocking%20Algorithm%20for%20Isolating%20Congruent%20Phylogenomic%20Datasets&query.author=Paul%20Planet&filter=issn:2047-217X&rows=1",
    3 => "https://api.crossref.org/works?query.bibliographic=Fractal%20Self-similarity,%20Scale%20Invariance%20and%20Stationary%20waves%20Codes%20Architecture%20Human%20Chromosomes%20DNA%20sequences&query.author=Jean%20Perez&filter=issn:2047-217X&rows=1",
    4 => "https://api.crossref.org/works?query.bibliographic=Mitochondrial%20Metagenomics:%20Letting%20the%20Genes%20out%20of%20the%20Bottle&query.author=Alfried%20Vogler&filter=issn:2047-217X&rows=1",
);


for ($i = 0; $i < count(array_unique($testArr)); $i++)
{
    $data = file_get_contents($testArr[$i]);
    $apiResults = json_decode($data, true);

    foreach ($apiResults as $result) {
//        print_r($result['items']);
        if (is_array($result['items']) || is_object($result['items'])) {
            foreach ($result['items'] as $test) {
                print($test['title'][0].' '.$test['DOI']."\n");
            }
        }
    }
}