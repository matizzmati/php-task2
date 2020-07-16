<?php 

require __DIR__ . '/vendor/autoload.php';

use simplehtmldom\HtmlWeb;
use webscraper\Scraper;

############ scrap page ############

$url = 'http://estoremedia.space/DataIT/';
$client = new HtmlWeb();
$html = $client->load($url);

$scraper = new Scraper($url, $html);

$pageUrls = $scraper->getPages();
foreach ($pageUrls as $url) {
    $scraper->addProductsData($client->load($url));
}

$products = $scraper->getProducts();


############ save to csv ############

if (file_exists('file.csv'))
{
    unlink('file.csv');
}

$fp = fopen('file.csv', 'w');
fputcsv($fp, array_keys($products[0]));
foreach ($products as $row) {
    fputcsv($fp, $row);
}

fclose($fp);

echo "scraping finished, records saved to file.csv" . PHP_EOL;

?>