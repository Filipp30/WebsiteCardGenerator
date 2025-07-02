<?php

use Sitemapgenerator\Sitemap\Generator\SitemapGenerator;
use Sitemapgenerator\Sitemap\Models\ChangeFreq;
use Sitemapgenerator\Sitemap\Models\Type;
use Sitemapgenerator\Sitemap\Models\WebPage;

require __DIR__ . '/../vendor/autoload.php';

try {
    $pages = [
        new WebPage('https://hh.ru', new DateTime("2020-12-14"), 1, ChangeFreq::DAILY),
        new WebPage('https://test.ru/news', new DateTime("2020-12-10"), 0.6, ChangeFreq::HOURLY),
        new WebPage('https://grigorukfilipp.org', new DateTime("2020-10-14"), 0.3, ChangeFreq::MONTHLY),
        new WebPage('https://test.ru/news/today', new DateTime("2020-01-10"), 0.9, ChangeFreq::NEVER),
    ];

    $generator = new SitemapGenerator($pages,Type::XML, __DIR__ . '/sitemap.xml');
    $generator = new SitemapGenerator($pages,Type::JSON, __DIR__ . '/sitemap.json');
    $generator = new SitemapGenerator($pages,Type::CSV, __DIR__ . '/sitemap.csv');

} catch (Exception $e) {
    echo $e->getMessage();
}