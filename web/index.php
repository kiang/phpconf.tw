<?php

require_once __DIR__.'/../vendor/autoload.php';

ini_set('date.timezone', 'Asia/Taipei');

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app['twig']->addExtension(new \Cuttle\Twig\Extension\TwigMarkdownExtension());

$pages = require __DIR__.'/pages.php';

foreach ($pages as $page) {
    $method = (isset($page['method']) ? strtoupper($page['method']) : 'GET');
    switch ($method) {
        case 'GET':
            $app->get($page['route'], $page['callback']);
            break;
        case 'POST':
            $app->post($page['route'], $page['callback']);
            break;
    }
}

$app->run();
