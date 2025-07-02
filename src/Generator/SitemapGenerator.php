<?php

namespace Sitemapgenerator\Sitemap\Generator;

use Sitemapgenerator\Sitemap\Exceptions\DirPathException;
use Sitemapgenerator\Sitemap\Exceptions\FileWriteException;
use Sitemapgenerator\Sitemap\Generator\Factory\CsvFactory;
use Sitemapgenerator\Sitemap\Generator\Factory\FactoryInterface;
use Sitemapgenerator\Sitemap\Generator\Factory\JsonFactory;
use Sitemapgenerator\Sitemap\Generator\Factory\XmlFactory;
use Sitemapgenerator\Sitemap\Models\Type;
use Sitemapgenerator\Sitemap\Models\WebPage;

class SitemapGenerator
{
    private array $pages;
    private string $filePath;

    /**
     * @param WebPage[] $pages
     * @param Type $type
     * @param string $filePath
     * @throws DirPathException
     * @throws FileWriteException
     */
    public function __construct(array $pages, Type $type, string $filePath)
    {
        $this->pages = $pages;
        $this->filePath = $filePath;

        $this->directoryExists(dirname($filePath));
        $factory = $this->getFactory($type);
        $this->generateFile($factory);
    }

    private function getFactory(Type $type): FactoryInterface
    {
        return match ($type) {
            Type::XML => new XMLFactory(),
            Type::CSV => new CSVFactory(),
            Type::JSON => new JsonFactory(),
        };
    }

    /**
     * @throws DirPathException
     */
    private function directoryExists(string $dir): void
    {
        if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
            throw new DirPathException($dir);
        }
    }

    /**
     * @throws FileWriteException
     */
    private function generateFile(FactoryInterface $factory): void
    {
        $content = $factory->generate($this->pages);

        if (file_put_contents($this->filePath, $content) === false) {
            throw new FileWriteException("Cannot write to path: {$this->filePath}");
        }
    }
}