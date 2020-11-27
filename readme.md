# Mint DOI project
To mint `DOI` for each Publon reviews, requirements at [here](https://docs.google.com/document/d/1CopK9e9QclOd91WRN1LREEBefMDb5cWoHiElj3IfKLc/edit#heading=h.njljz7framco)

## Progress
1. Prototype issues
    - [ ] Actions
        - [x] Test CrossRef API to query DOIs using paper titles
        - [x] Parse EM Excel file to extract data for papers
        - [ ] Test sandbox DataCite API to mint DOIs using peer review metadata
        - [ ] Look into Publons API access
    - [ ] Access to GigaScience paper DOIs
    - [ ] Access to peer review metadata
    - [ ] Access to DataCite API
    - [ ] Access to Publons API
2. Data flow
    - [ ] Flow diagram
3.     
    
### Actions
1. Test CrossRef API to query DOIs using paper titles, [link](https://www.crossref.org/education/retrieve-metadata/rest-api/a-non-technical-introduction-to-our-api/)
    - [API](https://github.com/CrossRef/rest-api-doc#queries)
    - `https://api.crossref.org/works?query.container-title=`  
    - `https://api.crossref.org/members?query=giga`
    - `https://api.crossref.org/works?query.bibliographic=Mitochondrial%20Metagenomics:%20Letting%20the%20Genes%20out%20of%20the%20Bottle&query.author=Alfried%20Vogler&filter=issn:2047-217X&rows=1`
2. Parse EM Excel file to extract data for papers using [SimpleXLSX](https://github.com/shuchkin/simplexlsx) which returns `Article Title` and `Corresponding Author name`  
[example](https://ssaurel.medium.com/parsing-microsoft-excel-files-in-php-easily-2b68c70ee3be#:~:text=Parsing%20The%20Excel%20File%20In%20PHP&text=First%20step%20is%20to%20include,parsed%20from%20the%20Excel%20file.)
3. Append `Article Title`, `Corresponding Author name` and `ISSN` to the crossref API  
4. Use `file_get_contents()` to get the crossref output  
5. Parse the output in json format and return  `Article Title` and `DOI`  
6. Test sandbox [DataCite API](https://support.datacite.org/docs/getting-started) to mint DOIs using peer review metadata  
7. Look into Publons API access  


### Usage
1. `php parseXlsx.php | less -S `, example output as below
```
Mitochondrial metagenomics: letting the genes out of the bottle 10.1186/s13742-016-0120-y
Bioboxes: standardised containers for interchangeable bioinformatics software 10.1186/s13742-015-0087-0
Clusterflock: a flocking algorithm for isolating congruent phylogenomic datasets 10.1186/s13742-016-0152-3
```

### Problem
1. There is a PHP warning in `if (is_array($result['items']) || is_object($result['items']))` :  
`PHP Warning:  Illegal string offset 'items'`  

### Reference
1. [SimpleXLSX](https://github.com/shuchkin/simplexlsx)
2. [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet)
3. GigaScience API for DOI at [here](http://gigadb.org/site/help)
4. CrossRef API [Introduction](https://www.crossref.org/education/retrieve-metadata/), [usage example](https://www.crossref.org/education/retrieve-metadata/rest-api/a-non-technical-introduction-to-our-api/), [API doc](https://github.com/CrossRef/rest-api-doc)
