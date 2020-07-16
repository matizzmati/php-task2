<?php
    
    require __DIR__ . '/vendor/autoload.php';
    
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
    $twig = new \Twig\Environment($loader);

    use simplehtmldom\HtmlWeb;
    use webscraper\ProductHtml;

    
    $url = $_GET["product_url"];
    $client = new HtmlWeb();
    $html = $client->load($url);
    
    $product = new ProductHtml($html);
    
    $product->addAttribute(['.price', '.price-promo'], 'innertext', 'price');
    $product->addAttribute(['.price-old'], 'innertext', 'price_old');
    $product->addAttribute(['.card-img-top'], 'src', 'img');
    $product->addAttribute(['.card-body .card-text'], 'innertext', 'name');
    $product->addReviews('reviews');
    $product->addRate('rate');
    $product->addVariantsAndCode();
    
    $productObject = $product->getProduct();
    
    $template = $twig->load('task2a.html');
    echo $template->render(['product' => $productObject]);

?>