<?php namespace webscraper;


class ProductHtml
{
    private $html;
    private $product = array();

    function __construct($html)
    {
        $this->html = $html;
    }

    public function addAttribute($selectors, $attr, $name)
    {
        $value = 'not found';
        foreach ($selectors as $selector) {
            $el = $this->html->find($selector, 0);
            if ($el) {
                $value = $el->{$attr};
            } else {
                continue;
            }
        }
        
        $this->product[$name] = $value;
    }

    public function addReviews($name)
    {
        $value = 'not found';
        $el = $this->html->find('.card-footer .text-muted', 0);
        if ($el) {
            preg_match('/\((.+)\)/', $el->innertext, $reviews);
            $value = $reviews[1];
        }
        
        $this->product[$name] = $value;
    }

    public function addRate($name)
    {
        $value = 'not found';
        $el = $this->html->find('.card-footer .text-muted', 0);
        if ($el) {
            $allstars = explode(" ", $el->innertext);
            $stars = base64_encode($allstars[0]);
            $starString = "4piF";
            $value = substr_count($stars, $starString);
        }

        $this->product[$name] = $value;
    }

    public function addVariantsAndCode()
    {
        $scripts = $this->html->find('script');
        foreach ($scripts as $s) {
            if (strpos($s->innertext, 'products')) {
                $script = $s->innertext;
            }
        }
        $json = json_decode($script, true);
        
        $this->product['code'] = $json["products"]["code"];

        $variants =  $json["products"]["variants"];
        if (!empty($variants)) {
            $this->product['variants'] = $variants;
        }
    }

    public function getProduct()
    {
        return $this->product;
    }

}

?>