<?php

require_once __DIR__.'/../vendor/autoload.php';

ini_set('date.timezone', 'Asia/Taipei');

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app['twig']->addExtension(new \Cuttle\Twig\Extension\TwigMarkdownExtension());

$pages = require __DIR__.'/pages.php';

// generate static html files
foreach ($pages as $page) {
    $filePath = __DIR__ . '/public/2012/' .$page['pageName'];
    echo 'generate page: ', $filePath, PHP_EOL;
    file_put_contents($filePath, $page['callback']());
}

// generate stylesheets
echo `compass compile --css-dir public/2012/stylesheets`;
