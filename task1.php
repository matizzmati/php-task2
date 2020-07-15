<?php 

require __DIR__ . '/vendor/autoload.php';

use webscraper\Scraper;

$scraper = new Scraper('http://estoremedia.space/DataIT/');

$scraper->test();
$scraper->getPages();


?>