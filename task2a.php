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
    
    $img = $product->getImg('.card-img-top');


    
    $template = $twig->load('task2a.html');
    echo $template->render(['img' => $img]);

?>