<?php

namespace Sitemapgenerator\Sitemap\Exceptions;

use Exception;
class FileWriteException extends Exception
{
    public function __construct(string $filePath)
    {
        parent::__construct("Cannot write to path: {$this->filePath}");
    }
}