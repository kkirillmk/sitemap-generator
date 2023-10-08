<?php

namespace Kkirillmk\SitemapGenerator\Generators;

use XMLWriter;

class XmlGenerator extends BaseGenerator
{
    public function generate(array $pages, string $filepath): void
    {
        $xml = new XMLWriter();

        $xml->openUri($filepath);
        $xml->setIndent(true);
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xml->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $xml->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

        foreach ($pages as $page) {
            $xml->startElement('url');
            $xml->writeElement('loc', $page['loc']);
            $xml->writeElement('lastmod', $page['lastmod']);
            $xml->writeElement('priority', $page['priority']);
            $xml->writeElement('changefreq', $page['changefreq']);
            $xml->endElement();
        }

        $xml->endElement();
        $xml->endDocument();
        $xml->flush();
    }
}
