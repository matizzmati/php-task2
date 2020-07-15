<?php 

require __DIR__ . '/vendor/autoload.php';
use simplehtmldom\HtmlWeb;
use webscraper\Scraper;

$client = new HtmlWeb();
$html = $client->load('http://estoremedia.space/DataIT/');


$test = new Scraper();
$test->test();



?>