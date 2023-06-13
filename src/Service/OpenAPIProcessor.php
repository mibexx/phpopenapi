<?php

namespace Mibexx\PHPOpenApi\Service;

use Mibexx\PHPOpenApi\Domain\Model\Components;
use Mibexx\PHPOpenApi\Domain\Model\ExternalDocs;
use Mibexx\PHPOpenApi\Domain\Model\Info;
use Mibexx\PHPOpenApi\Domain\Model\OpenAPIDto;
use Mibexx\PHPOpenApi\Infrastructure\Persistence\OpenAPIFileReader;
use Symfony\Component\Yaml\Yaml;

class OpenAPIProcessor
{
    private OpenAPIFileReader $fileReader;

    public function __construct(OpenAPIFileReader $fileReader)
    {
        $this->fileReader = $fileReader;
    }

    public function process(string $source): OpenAPIDto
    {
        $swaggerYaml = $this->fileReader->readSpecification($source);
        $swaggerData = Yaml::parse($swaggerYaml);

        $openapi = $swaggerData['openapi'] ?? '';
        $info = $this->extractInfo($swaggerData['info'] ?? []);
        $servers = $swaggerData['servers'] ?? [];
        $paths = $swaggerData['paths'] ?? [];
        $components = $this->extractComponents($swaggerData['components'] ?? []);
        $security = $swaggerData['security'] ?? [];
        $tags = $swaggerData['tags'] ?? [];
        $externalDocs = $this->extractExternalDocs($swaggerData['externalDocs'] ?? []);

        return new OpenAPIDto($openapi, $info, $servers, $paths, $components, $security, $tags, $externalDocs);
    }

    private function extractInfo(array $infoData): Info
    {
        $title = $infoData['title'] ?? '';
        $version = $infoData['version'] ?? '';
        $description = $infoData['description'] ?? null;

        return new Info($title, $version, $description);
    }

    private function extractComponents(array $componentsData): Components
    {
        $schemas = $componentsData['schemas'] ?? [];

        $components = new Components();
        $components->schemas = $schemas;

        return $components;
    }

    private function extractExternalDocs(array $externalDocsData): ExternalDocs
    {
        $url = $externalDocsData['url'] ?? null;
        $description = $externalDocsData['description'] ?? null;

        return new ExternalDocs($url, $description);
    }
}
