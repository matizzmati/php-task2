<?php

    require __DIR__ . '/vendor/autoload.php';

    use simplehtmldom\HtmlWeb;
    use webscraper\ProductHtml;

    $url = $_GET["product_url"];
    $client = new HtmlWeb();
    $html = $client->load($url);
    
    $product = new ProductHtml($html);
    
    $img = $product->getImg('.card-img-top');

?>

<!DOCTYPE html>
<html lang="pl">

	<head>
		<meta charset="utf-8">

	</head>

	<body>
        <?php echo $img; ?>
	</body>

</html>