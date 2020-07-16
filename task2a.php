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
        <style>
            .back { padding:10px;display:block;margin-bottom:5vh;border:2px solid black;text-align:center;width:100px;}
        </style>
	</head>

	<body>
        <div><a class="back" href="task2.php"><-- BACK</a></div>
        <?php echo $img; ?>
	</body>

</html>