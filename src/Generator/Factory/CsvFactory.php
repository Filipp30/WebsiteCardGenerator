<?php

namespace Sitemapgenerator\Sitemap\Generator\Factory;
class CsvFactory implements FactoryInterface
{
    public function generate(array $pages): string
    {
        $output = "loc;lastmod;priority;changefreq\n";
        foreach ($pages as $page) {
            $page = $page->toArray();

            $line = implode(';', [
                $page['loc'],
                $page['lastmod'],
                $page['priority'],
                $page['changefreq']
            ]);
            $output .= $line . "\n";
        }
        return $output;
    }
}