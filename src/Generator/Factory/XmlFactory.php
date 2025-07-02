<?php

namespace Sitemapgenerator\Sitemap\Generator\Factory;

use SimpleXMLElement;

class XmlFactory implements FactoryInterface
{
    public function generate(array $pages): string
    {
        $xml = new SimpleXMLElement('<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"></urlset>');
        foreach ($pages as $page) {

            $page = $page->toArray();

            $url = $xml->addChild('url');
            $url->addChild('loc', htmlspecialchars($page['loc']));
            $url->addChild('lastmod', $page['lastmod']);
            $url->addChild('priority', $page['priority']);
            $url->addChild('changefreq', $page['changefreq']);
        }

        return $xml->asXML();
    }
}