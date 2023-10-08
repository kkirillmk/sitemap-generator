<?php

namespace Kkirillmk\SitemapGenerator\Generators\Interfaces;
use Kkirillmk\SitemapGenerator\Exceptions\FileAccessErrorException;

interface GeneratorInterface
{
    /**
     * Генерация карты сайта
     *
     * @param array[] $pages
     *   [
     *       'loc' => string,         // URL страницы
     *       'lastmod' => string,     // Дата последнего изменения страницы
     *       'priority' => float,     // Приоритет страницы (число)
     *       'changefreq' => string,  // Частота изменений страницы (например, 'hourly', 'daily')
     *   ]
     * @param string $filepath
     *
     * @throws FileAccessErrorException
     */
    public function generate(array $pages, string $filepath): void;
}