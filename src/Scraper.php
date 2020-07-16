<?php namespace webscraper;


class Scraper
{
    private $weburl;
    private $html;
    private $pages = array();
    private $productLinks = array();
    private $products = array();
    

    function __construct($url, $html)
    {
        $this->weburl = $url;
        $this->html = $html;
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

        return $this->pages;
    }

    public function addProductsData($pageHtml)
    {
        $productData = array();

        foreach ($pageHtml->find('.card') as $product)
        {
            # name 
            $productData["name"] = $this->getElement($product, '.title', 'data-name');
            
            # url
            $productData["url"] = $this->weburl . $this->getElement($product, '.title', 'href');

            # img
            $productData["img"] = $this->getElement($product, '.card-img-top', 'src');
            
            # price
            $productData["price"] = $this->getElement($product, '.card-body h5', 'innertext');

            # reviews
            $productData["reviews"] = $this->getReviews($product);

            # stars
            $productData["rate"] = $this->getRate($product);
            
            
            $this->products[] = $productData;
        }
        
    }

    private function getElement($productHtml, $selector, $attr)
    {

        $el = $productHtml->find($selector, 0);
        if ( $el )
        {
            return $el->{$attr};
        }
        else
        {
            return 'not found';
        }
     
    }

    private function getReviews($productHtml)
    {
        $el = $productHtml->find('.card-footer .text-muted', 0);
        if ($el)
        {
            preg_match('/\((.+)\)/', $el->innertext, $reviews);
            return $reviews[1];
        }
        else
        {
            return 'not found';
        }
    }

    private function getRate($productHtml)
    {
        $el = $productHtml->find('.card-footer .text-muted', 0);
        if ($el)
        {
            $allstars = explode(" ", $el->innertext);
            $stars = base64_encode($allstars[0]);
            $starString = "4piF";
            return substr_count($stars, $starString);
        }
        else
        {
            return 'not found';
        }
    }

    public function getProducts() {
        return $this->products;
    }

}

?>