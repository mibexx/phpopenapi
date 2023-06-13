<?php

namespace Mibexx\PHPOpenApi\Tests\Service;

use Mibexx\PHPOpenApi\Domain\Model\OpenAPIDto;
use Mibexx\PHPOpenApi\Infrastructure\Persistence\OpenAPIFileReader;
use Mibexx\PHPOpenApi\Service\OpenAPIProcessor;
use PHPUnit\Framework\TestCase;

class OpenAPIProcessorTest extends TestCase
{
    private OpenAPIProcessor $openAPIProcessor;

    protected function setUp(): void
    {
        $fileReader = new OpenAPIFileReader();
        $this->openAPIProcessor = new OpenAPIProcessor($fileReader);
    }

    public function testProcess(): void
    {
        $source = __DIR__ . '/../../example/openapi.yaml';
        $openapiDto = $this->openAPIProcessor->process($source);

        $this->assertInstanceOf(OpenAPIDto::class, $openapiDto);

        // Assert OpenAPI version
        $this->assertEquals('3.0.3', $openapiDto->openapi);

        // Assert Info properties
        $this->assertEquals('Swagger Petstore - OpenAPI 3.0', $openapiDto->info->title);
        $this->assertEquals('1.0.11', $openapiDto->info->version);

        // Assert ExternalDocs properties
        $this->assertEquals('Find out more about Swagger', $openapiDto->externalDocs->description);
        $this->assertEquals('http://swagger.io', $openapiDto->externalDocs->url);

        // Assert Servers
        $this->assertIsArray($openapiDto->servers);
        $this->assertCount(1, $openapiDto->servers);
        $this->assertEquals('https://petstore3.swagger.io/api/v3', $openapiDto->servers[0]['url']);

        // Assert Tags
        $this->assertIsArray($openapiDto->tags);
        $this->assertCount(3, $openapiDto->tags);
        $this->assertEquals('pet', $openapiDto->tags[0]['name']);
        $this->assertEquals('Everything about your Pets', $openapiDto->tags[0]['description']);
        $this->assertEquals('store', $openapiDto->tags[1]['name']);
        $this->assertEquals('Access to Petstore orders', $openapiDto->tags[1]['description']);
        $this->assertEquals('user', $openapiDto->tags[2]['name']);
        $this->assertEquals('Operations about user', $openapiDto->tags[2]['description']);

        // Assert Paths
        $this->assertIsArray($openapiDto->paths);
        // Assert other properties as needed
    }
}
