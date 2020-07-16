<?php 

require __DIR__ . '/vendor/autoload.php';

use simplehtmldom\HtmlWeb;
use webscraper\Scraper;

$url = 'http://estoremedia.space/DataIT/';
$client = new HtmlWeb();
$html = $client->load($url);

$scraper = new Scraper($url, $html);

//$scraper->test();

$pages = $scraper->getPages();
$productLinks = array();

foreach ($pages as $page)
{
    $pageHtml = $client->load($page);
    foreach ($pageHtml->find('.card .title') as $product)
    {
        $productLinks[] = $url . $product->href;
    }
}

$product1html = $client->load($productLinks[0]);
$product1 = $product1html->find('.card .card-text', 0);
print_r($product1->innertext);


?>