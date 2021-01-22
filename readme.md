# Mint DOI project
To mint `DOI` for each Publon reviews, requirements at [here](https://docs.google.com/document/d/1CopK9e9QclOd91WRN1LREEBefMDb5cWoHiElj3IfKLc/edit#heading=h.njljz7framco)

## Progress
1. Prototype issues
    - [ ] Actions
        - [x] Test CrossRef API to query DOIs using paper titles  
        - [x] Parse EM Excel file to extract data for papers  
        - [x] Look into Publons API access  
            - Created an account and got the API token  
            - API methods [article/DOI](https://publons.com/api/v2/) not yet released.  
            - Any other alternative?  
        - [x] Test sandbox DataCite API to mint DOIs using peer review metadata
            - Try to append DOI to it, but it returns 404  
              `{"errors":[{"status":"404","title":"The resource you are looking for doesn't exist."}]}`
            - https://api.test.datacite.org/dois/10.1186/s13742-016-0120-y

  
    
### How does the script work
1. Test CrossRef API to query DOIs using paper titles, [link](https://www.crossref.org/education/retrieve-metadata/rest-api/a-non-technical-introduction-to-our-api/)
    - [API](https://github.com/CrossRef/rest-api-doc#queries)
    - `https://api.crossref.org/works?query.bibliographic=Mitochondrial%20Metagenomics:%20Letting%20the%20Genes%20out%20of%20the%20Bottler&filter=issn:2047-217X&rows=1`
2. Parse EM Excel file to extract data for papers using [SimpleXLSX](https://github.com/shuchkin/simplexlsx) which returns `Article Title`, [example](https://ssaurel.medium.com/parsing-microsoft-excel-files-in-php-easily-2b68c70ee3be#:~:text=Parsing%20The%20Excel%20File%20In%20PHP&text=First%20step%20is%20to%20include,parsed%20from%20the%20Excel%20file.)  
3. Append `Article Title` and `ISSN` to the crossref API  
4. Use `file_get_contents()` to get the crossref output  
5. Parse the output in json format and return  `Article Title` and `DOI`  


### Usage
1. `php parseXlsx.php {fromEM}.xlsx `  
2.  A file with name `{fromEM}-Y-m-d.minted.csv` will then produced  
3.  Open the csv file in excel and will see 3 columns

| CrossRef API return status | Formatted DOI | Title |  
|---|---|---|  
| ok | https://doi.org/10.1186/s13742-016-0143-4 | RES-Scanner: a software package for genome-wide identification of RNA-editing sites |

### Output explanation
1. The script returns the `Article title` and its `CrossRef DOI`, `ok` at the end indicates this article `is found` in CrossRef database.  
2. `This article is not found in CrossRef!!!` indicates CrossRef database has no information about this article.  

### Problem

### Reference
1. [SimpleXLSX](https://github.com/shuchkin/simplexlsx)
2. [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet)
3. GigaScience API for DOI at [here](http://gigadb.org/site/help)
4. CrossRef API [Introduction](https://www.crossref.org/education/retrieve-metadata/)   
    - [usage example](https://www.crossref.org/education/retrieve-metadata/rest-api/a-non-technical-introduction-to-our-api/)  
    - [API doc](https://github.com/CrossRef/rest-api-doc)  
    - [DOI Content Negotiation](https://citation.crosscite.org/docs.html)
5. CrossCite [DOI Content Negotiation](https://citation.crosscite.org/docs.html)  
