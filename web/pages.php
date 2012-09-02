<?php

/** @var \Silex\Application $app */

$view = array(
    'google_analytics_id' => 'UA-34341254-1',
);

$pages = array();

$pages[] = array(
    'route' => '/',
    'pageName' => 'index.html',
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
        $view['pageName'] = 'index.html';

        return $app['twig']->render('index.twig', array('view' => $view));
    },
);

$pages[] = array(
    'route' => '/schedules',
    'pageName' => 'schedules.html',
    'callback' => function() use ($app, $view) {
        $view['pageName'] = 'schedules.html';
        return $app['twig']->render('schedules.twig', array('view' => $view));
    },
);

$pages[] = array(
    'route' => '/speakers',
    'pageName' => 'speakers.html',
    'callback' => function() use ($app, $view) {
        $view['pageName'] = 'speakers.html';
        return $app['twig']->render('speakers.twig', array('view' => $view));
    },
);

$pages[] = array(
    'route' => '/location',
    'pageName' => 'location.html',
    'callback' => function() use ($app, $view) {
        $view['pageName'] = 'location.html';
        return $app['twig']->render('location.twig', array('view' => $view));
    },
);

$pages[] = array(
    'route' => '/about',
    'pageName' => 'about.html',
    'callback' => function() use ($app, $view) {
        $view['pageName'] = 'about.html';
        return $app['twig']->render('about.twig', array('view' => $view));
    }
);

return $pages;
