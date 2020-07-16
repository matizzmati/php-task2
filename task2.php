<?php
    
    require __DIR__ . '/vendor/autoload.php';
    
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
    $twig = new \Twig\Environment($loader);

    $csv = array_map('str_getcsv', file('file.csv'));
    $csvFirstRow = array_shift($csv);
    
    $template = $twig->load('task2.html');
    echo $template->render(['products' => $csv, 'firstRow' => $csvFirstRow]);

?>