<?php

require_once 'vendor/autoload.php';

use Kkirillmk\SitemapGenerator\SitemapGenerator;

$pages = [
    [
        'loc' => 'https://site.ru/',
        'lastmod' => '2020-12-14',
        'priority' => 1,
        'changefreq' => 'hourly',
    ],
    [
        'loc' => 'https://site.ru/news',
        'lastmod' => '2020-12-10',
        'priority' => 0.5,
        'changefreq' => 'daily',
    ],
    [
        'loc' => 'https://site.ru/about',
        'lastmod' => '2020-12-07',
        'priority' => 0.1,
        'changefreq' => 'weekly',
    ],
    [
        'loc' => 'https://site.ru/products',
        'lastmod' => '2020-12-12',
        'priority' => 0.5,
        'changefreq' => 'daily',
    ],
    [
        'loc' => 'https://site.ru/products/ps5',
        'lastmod' => '2020-12-11',
        'priority' => 0.1,
        'changefreq' => 'weekly',
    ],
    [
        'loc' => 'https://site.ru/products/xbox',
        'lastmod' => '2020-12-12',
        'priority' => 0.1,
        'changefreq' => 'weekly',
    ],
    [
        'loc' => 'https://site.ru/products/wii',
        'lastmod' => '2020-12-11',
        'priority' => 0.1,
        'changefreq' => 'weekly',
    ],
];

$xmlFilePath  = 'sitemap/sitemap.xml';
$csvFilePath  = 'sitemap/sitemap.csv';
$jsonFilePath = 'sitemap/sitemap.json';

try {
    $generator = new SitemapGenerator($pages, $xmlFilePath);
    $generator->generate();

    echo 'XML sitemap generated successfully!' . "\n";
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}

try {
    $generator = new SitemapGenerator($pages, $csvFilePath);
    $generator->generate();

    echo 'Csv sitemap generated successfully!' . "\n";
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}

try {
    $generator = new SitemapGenerator($pages, $jsonFilePath);
    $generator->generate();

    echo 'Json sitemap generated successfully!' . "\n";
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}