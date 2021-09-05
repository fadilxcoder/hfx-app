# Notes

- Use **virtual host**
- Command : `php bin/console database:users up|down|seed`
- Elasticsearch
- Algolia with below configs
- - https://curl.haxx.se/ca/cacert.pem
- - `curl.cainfo="C:\wamp64\www\hfx-app\cacert.pem"` in php.ini via Apache
- Custom made command in `composer.json` - `php bin/console who:am:i`
- Curl extension should be activated in php

## Packages

- https://packagist.org/packages/josantonius/session - `composer require josantonius/session`
- Algolia - https://packagist.org/packages/algolia/algoliasearch-client-php - `composer require algolia/algoliasearch-client-php`
- Algolia Docs - https://www.algolia.com/doc/api-client/getting-started/install/php/?client=php
- ESX - https://packagist.org/packages/elasticsearch/elasticsearch - `composer req elasticsearch/elasticsearch`

## Converting PDF to text (.md)

- https://packagist.org/packages/spatie/pdf-to-text -  `composer require spatie/pdf-to-text`
- File : `PdfGeneratorCommand.php`
- Command to generate PDF `php bin/console generate:pdf`
- PDFs : `public/pdf/*.pdf`
- Mardown file (.md) : `public/pdf-to-text/text-file.md` 

