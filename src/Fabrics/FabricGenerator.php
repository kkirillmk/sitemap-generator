<?php

namespace Kkirillmk\SitemapGenerator\Fabrics;

use Kkirillmk\SitemapGenerator\Enums\ExtensionsEnum;
use Kkirillmk\SitemapGenerator\Generators\CsvGenerator;
use Kkirillmk\SitemapGenerator\Generators\JsonGenerator;
use Kkirillmk\SitemapGenerator\Generators\XmlGenerator;
use Kkirillmk\SitemapGenerator\Generators\Interfaces\GeneratorInterface;

class FabricGenerator
{
    public static function getByExtensions(ExtensionsEnum $extension): GeneratorInterface
    {
        return match ($extension) {
            ExtensionsEnum::XML  => new XmlGenerator(),
            ExtensionsEnum::CSV  => new CsvGenerator(),
            ExtensionsEnum::JSON => new JsonGenerator(),
        };
    }
}
