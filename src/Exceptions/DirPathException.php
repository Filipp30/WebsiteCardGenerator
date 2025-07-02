<?php

namespace Sitemapgenerator\Sitemap\Exceptions;

use Exception;

class DirPathException extends Exception
{
    public function __construct(string $dir)
    {
        parent::__construct("Directory '$dir' was not created or not exists");
    }
}