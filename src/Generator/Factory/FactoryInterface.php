<?php

namespace Sitemapgenerator\Sitemap\Generator\Factory;

use Sitemapgenerator\Sitemap\Models\WebPage;
interface FactoryInterface
{
    /**
     * @param WebPage[] $pages
     * @return string
     */
    public function generate(array $pages): string;
}