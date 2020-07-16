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

    public function getProductUrls($pages)
    {
        foreach ($pages as $page)
        {
            foreach ($page->find('.card .title') as $product)
            {
                $this->productLinks[] = $this->weburl . $product->href;
            }
        }

        return $this->productLinks;
    }

    public function addProductData($productHtml, $url)
    {
        $productData = array();

        # name 
        $productData["name"] = $this->getElement($productHtml, ['.card .card-text'], 'innertext');

        # url
        $productData["url"] = $url;

        # img
        $productData["img"] = $this->getElement($productHtml, ['.card-img-top'], 'src');
        
        # price
        $productData["price"] = $this->getElement($productHtml, ['.price', '.price-promo'], 'innertext');

        # reviews
        $productData["reviews"] = $this->getReviews($productHtml);

        # stars
        $productData["rate"] = $this->getRate($productHtml);
        

        $this->products[] = $productData;
    }

    private function getElement($productHtml, $selectors, $attr)
    {
        foreach ($selectors as $selector)
        {
            $el = $productHtml->find($selector, 0);
            if ( $el )
            {
                return $el->{$attr};
            }
            else
            {
                continue;
            }
        }
        return 'not found';
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