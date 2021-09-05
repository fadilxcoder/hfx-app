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
- Assets minify
- - https://packagist.org/packages/mrclay/minify
- - https://github.com/mrclay/minify/blob/HEAD/docs/Install.wiki.md (Installation)
- - `composer require mrclay/minify`
- - `mkdir public/min`
- - `MIN=public/min/`
- - `MINIFY=vendor/mrclay/minify/`
- - `cp ${MINIFY}example.index.php ${MIN}index.php`
- - `cp ${MINIFY}config.php ${MIN}`
- - `cp ${MINIFY}groupsConfig.php ${MIN}`
- - `cp ${MINIFY}quick-test.js ${MIN}`
- - `cp ${MINIFY}quick-test.css ${MIN}`
- - Add `min/?f=` between end of URL and path of assets
- - Adjust path of autoloader in `public/min/index.php`
- - https://github.com/mrclay/minify/blob/c80add80a210b29a5f45d7c66b664748ab05544c/docs/UserGuide.wiki.md (Creating Minify URLs)
- - https://github.com/mrclay/minify/blob/master/docs/Debugging.wiki.md (Javascript/CSS Problems)

## Converting PDF to text (.md)

- https://packagist.org/packages/spatie/pdf-to-text -  `composer require spatie/pdf-to-text`
- File : `PdfGeneratorCommand.php`
- Command to generate PDF `php bin/console generate:pdf`
- PDFs : `public/pdf/*.pdf`
- Mardown file (.md) : `public/pdf-to-text/text-file.md` 

