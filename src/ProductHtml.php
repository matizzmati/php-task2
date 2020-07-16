<?php namespace webscraper;


class ProductHtml
{
    private $html;

    function __construct($html)
    {
        $this->html = $html;
    }

    public function getImg($selector)
    {
        $el = $this->html->find($selector, 0);
        if ($el)
        {
            return $el->src;
        }
        return 'not found';
    }

}

?>