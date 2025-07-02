<?php

namespace Sitemapgenerator\Sitemap\Models;

enum Type: string
{
    case XML = 'xml';
    case CSV = 'csv';
    case JSON = 'json';
}
