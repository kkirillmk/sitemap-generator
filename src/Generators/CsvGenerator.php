<?php

namespace Kkirillmk\SitemapGenerator\Generators;

use Kkirillmk\SitemapGenerator\Exceptions\FileAccessErrorException;

class CsvGenerator extends BaseGenerator
{
    public function generate(array $pages, string $filepath): void
    {
        $file = fopen($filepath, 'w');

        if (!$file) {
            throw new FileAccessErrorException("Failed to access to {$filepath}");
        }

        fputcsv($file, $this->generatorFields);

        foreach ($pages as $page) {
            fputcsv($file, [
                $page['loc'],
                $page['lastmod'],
                $page['priority'],
                $page['changefreq'],
            ]);
        }

        fclose($file);

        if (!file_exists($filepath)) {
            throw new FileAccessErrorException("Failed to write CSV sitemap to {$filepath}");
        }
    }
}
