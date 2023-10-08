<?php

namespace Kkirillmk\SitemapGenerator;

use Kkirillmk\SitemapGenerator\Enums\ExtensionsEnum;
use Kkirillmk\SitemapGenerator\Exceptions\DirectoryCreateErrorException;
use Kkirillmk\SitemapGenerator\Exceptions\FileAccessErrorException;
use Kkirillmk\SitemapGenerator\Exceptions\InvalidDataException;
use Kkirillmk\SitemapGenerator\Fabrics\FabricGenerator;
use Throwable;

class SitemapGenerator
{

    public function __construct(
        private readonly array  $pages,
        private readonly string $filepath,
        private readonly string $filetype = ''
    )
    {
    }

    /**
     * @throws InvalidDataException
     * @throws DirectoryCreateErrorException
     * @throws FileAccessErrorException
     */
    public function generate(): void
    {
        foreach ($this->pages as $page) {
            $this->validatePageData($page);
        }

        $extensionEnum = $this->getExtensionEnum();

        $this->createDirectory();

        $generator = FabricGenerator::getByExtensions($extensionEnum);

        $generator->generate($this->pages, $this->filepath);
    }

    /**
     * @throws InvalidDataException
     */
    protected function validatePageData($page): void
    {
        $requiredKeys = ['loc', 'lastmod', 'priority', 'changefreq'];

        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $page) || empty($page[$key])) {
                throw new InvalidDataException("Missing or empty '$key' in page data");
            }
        }
    }

    /**
     * @throws InvalidDataException
     */
    private function getExtensionEnum(): ExtensionsEnum
    {
        if (!empty($this->filetype)) {
            $fileExtension = $this->filetype;
        } else {
            $fileExtension = pathinfo($this->filepath, PATHINFO_EXTENSION);
        }

        try {
            return ExtensionsEnum::from($fileExtension);
        } catch (Throwable $exception) {
            throw new InvalidDataException('File Extension error: ' . $exception->getMessage());
        }
    }

    /**
     * @throws DirectoryCreateErrorException
     */
    private function createDirectory(): void
    {
        $directory = dirname($this->filepath);

        if (!is_dir($directory)) {
            $resultDirectoryCreate = mkdir($directory, 0755, true);

            if (!$resultDirectoryCreate) {
                throw new DirectoryCreateErrorException('Error when creating a directory');
            }
        }
    }
}
