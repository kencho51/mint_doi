# Mint DOI project
To mint `DOI` for each Publon reviews

## Progress
1. Prototype issues
    - [ ] Actions
        - [x] Test CrossRef API to query DOIs using paper titles
        - [x] Parse EM Excel file to extract data for papers
        - [x] Extract paper title, first author last name and last name
        - [ ] Test sandbox DataCite API to mint DOIs using peer review metadata
        - [ ] Look into Publons API access
    - [ ] Access to GigaScience paper DOIs
    - [ ] Access to peer review metadata
    - [ ] Access to DataCite API
2. Data flow
    - [ ] Flow diagram
3.     
    
### Actions
---
1. Test CrossRef API to query DOIs using paper titles, [link](https://www.crossref.org/education/retrieve-metadata/rest-api/a-non-technical-introduction-to-our-api/)
    - [API](https://github.com/CrossRef/rest-api-doc#queries)
    - `https://api.crossref.org/works?query.container-title=`  
    - `https://api.crossref.org/members?query=giga`
2. Parse EM Excel file to extract data for papers using [SimpleXLSX](https://github.com/shuchkin/simplexlsx) which returns array of each row,
[example](https://ssaurel.medium.com/parsing-microsoft-excel-files-in-php-easily-2b68c70ee3be#:~:text=Parsing%20The%20Excel%20File%20In%20PHP&text=First%20step%20is%20to%20include,parsed%20from%20the%20Excel%20file.)
```php
<?php

require 'vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';

if ( $xlsx = SimpleXLSX::parse('report.xlsx') ) {
    print_r( $xlsx->rows() );
} else {
    echo SimpleXLSX::parseError();
}
```
3. Test sandbox DataCite API to mint DOIs using peer review metadata  
4. Look into Publons API access  


### Reference
1. [SimpleXLSX](https://github.com/shuchkin/simplexlsx)
2. [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet)
3. GigaScience API for DOI at [here](http://gigadb.org/site/help)
4. CrossRef API [Introduction](https://www.crossref.org/education/retrieve-metadata/), [usage example](https://www.crossref.org/education/retrieve-metadata/rest-api/a-non-technical-introduction-to-our-api/), [API doc](https://github.com/CrossRef/rest-api-doc)
