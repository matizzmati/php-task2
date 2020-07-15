<?php namespace webscraper;

require './vendor/autoload.php';

use simplehtmldom\HtmlWeb;

class Scraper extends HtmlWeb
{
    private $weburl;
    private $html;
    private $pages = array();
    private $productLinks = array();
    

    function __construct($url)
    {
        $this->weburl = $url;
        $this->html = $this->load($url);
    }

    public function test()
    {
        echo 'test';
    }

    public function getPages()
    {
        foreach ($this->html->find('[data-page]') as $page)
        {
            $this->pages[] = $this->weburl . '?page=' . $page->{'data-page'};
        }

        $this->pages = array_unique($this->pages);
    }

    public function getProductPages()
    {
        foreach ($this->pages as $page)
        {
            $pageHtml = $this->load($page);
            foreach ($pageHtml->find('.card .title') as $product)
            {
                $this->productLinks[] = $this->weburl . $product->href;
            }
        }

        print_r($this->productLinks);
    }
}

?>