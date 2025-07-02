<?php

namespace Sitemapgenerator\Sitemap\Generator\Factory;

class JsonFactory implements FactoryInterface
{
    public function generate(array $pages): string
    {
        $pages = array_map(function ($page) {
            return $page->toArray();
        }, $pages);

        return json_encode($pages, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}