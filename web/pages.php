<?php

/** @var \Silex\Application $app */

$view = array(
    'root_url' => 'http://localhost:10000',
    'google_analytics_id' => 'UA-34341254-1',
);

$pages = array();

$pages[] = array(
    'route' => '/',
    'callback' => function() use ($app, $view) {
    $newsViewPath = $app['twig.path'] . '/news';
    $newsViews = array(
        $newsViewPath . '/2012-08-16-Call-for-Creativity.markdown',
        $newsViewPath . '/2012-08-20-PHPconf-2012-balabala.markdown',
    );
    $yaml = new \Symfony\Component\Yaml\Parser();
    $news = array();
    foreach ($newsViews as $newsView) {
        $yamlViewData = '';
        $viewBody = '';
        $viewData = array();

        $content = file_get_contents($newsView);

        list(, $yamlViewData, $viewBody) = explode('---', $content);

        $viewData = $yaml->parse($yamlViewData);

        $viewData['content'] = $viewBody;
        $news[] = $viewData;
    }

    usort($news, function ($v1, $v2) {
        $time1 = strtotime($v1['date']);
        $time2 = strtotime($v2['date']);

        if ($time1 === $time2) return 0;
        else if ($time1 > $time2) return 1;
        return -1;
    });

    $view['news'] = $news;

    $html = $app['twig']->render('index.twig', array('view' => $view));

    file_put_contents(__DIR__.'/public/2012/index.html', $html);

    return $html;
    },
);

$pages[] = array(
    'route' => '/schedule',
    'callback' => function() use ($app, $view) {
    $html = $app['twig']->render('schedule.twig', array('view' => $view));

    file_put_contents(__DIR__.'/public/2012/schedule.html', $html);

    return $html;
});

$pages[] = array(
    'route' => '/speakers',
    'callback' => function() use ($app, $view) {
    $html = $app['twig']->render('speakers.twig', array('view' => $view));

    file_put_contents(__DIR__.'/public/2012/speakers.html', $html);

    return $html;
});

$pages[] = array(
    'route' => '/venue',
    'callback' => function() use ($app, $view) {
    $html = $app['twig']->render('venue.twig', array('view' => $view));

    file_put_contents(__DIR__.'/public/2012/venue.html', $html);

    return $html;
});

$pages[] = array(
    'route' => '/about',
    'callback' => function() use ($app, $view) {
    $html = $app['twig']->render('about.twig', array('view' => $view));

    file_put_contents(__DIR__.'/public/2012/about.html', $html);

    return $html;
});

return $pages;
