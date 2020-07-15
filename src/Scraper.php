<?php namespace webscraper;

require './vendor/autoload.php';

use simplehtmldom\HtmlWeb;

class Scraper extends HtmlWeb
{
    private $html;
    private $pages = array();
    private $productLinks = array();
    

    function __construct($url)
    {
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
            $this->pages[] = 'http://estoremedia.space/DataIT/?page=' . $page->{'data-page'};
        }

        $this->pages = array_unique($this->pages);
    }
}

?>