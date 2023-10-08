<?php

namespace Kkirillmk\SitemapGenerator\Generators;

use Kkirillmk\SitemapGenerator\Exceptions\FileAccessErrorException;

class JsonGenerator extends BaseGenerator
{
    public function generate(array $pages, string $filepath): void
    {
        $jsonContent = json_encode($pages, JSON_PRETTY_PRINT);

        if ($jsonContent === false) {
            throw new FileAccessErrorException("Failed to encode JSON data.");
        }

        $result = file_put_contents($filepath, $jsonContent);

        if ($result === false) {
            throw new FileAccessErrorException("Failed to write JSON sitemap to {$filepath}");
        }
    }
}
