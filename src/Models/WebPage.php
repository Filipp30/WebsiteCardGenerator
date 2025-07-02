<?php

namespace Sitemapgenerator\Sitemap\Models;

use DateTime;
use Sitemapgenerator\Sitemap\Exceptions\InvalidDataException;

class WebPage
{
    private string $loc;
    private string $lastMod;
    private float $priority;
    private string $changeFreq;

    /**
     * @throws InvalidDataException
     */
    public function __construct(string $loc, DateTime $lastMod, float $priority, ChangeFreq $changeFreq)
    {
        $this->setLoc($loc);
        $this->lastMod = $lastMod->format('Y-m-d');
        $this->setPriority($priority);
        $this->changeFreq = $changeFreq->value;
    }

    /**
     * @throws InvalidDataException
     */
    private function setLoc(string $loc): void
    {
        if (!filter_var($loc, FILTER_VALIDATE_URL)) {
            throw new InvalidDataException("Invalid URL");
        }
        $this->loc = $loc;
    }

    /**
     * @throws InvalidDataException
     */
    private function setPriority(float $priority): void
    {
        if ($priority < 0 || $priority > 1) {
            throw new InvalidDataException("Priority must be between 0 and 1!");
        }
        $this->priority = $priority;
    }

   public function toArray(): array
   {
       return [
           'loc' => $this->loc,
           'lastmod' => $this->lastMod,
           'priority' => $this->priority,
           'changefreq' => $this->changeFreq
       ];
   }
}