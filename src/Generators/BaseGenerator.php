<?php

namespace Kkirillmk\SitemapGenerator\Generators;

use Kkirillmk\SitemapGenerator\Generators\Interfaces\GeneratorInterface;

abstract class BaseGenerator implements GeneratorInterface
{
    protected array $generatorFields = [
        'loc',
        'lastmod',
        'priority',
        'changefreq',
    ];

    /**
     * {@inheritDoc}
     */
    abstract public function generate(array $pages, string $filepath): void;
}
