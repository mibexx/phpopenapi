<?php declare(strict_types=1);

namespace Mibexx\PHPOpenApi\Application;

use Mibexx\PHPOpenApi\Domain\Model\OpenAPIDto;
use Mibexx\PHPOpenApi\Infrastructure\Persistence\OpenAPIFileReader;
use Mibexx\PHPOpenApi\Service\OpenAPIProcessor;

class OpenAPIFacade
{
    private OpenAPIProcessor $openAPIProcessor;

    public function __construct()
    {
        $fileReader = new OpenAPIFileReader();
        $this->openAPIProcessor = new OpenAPIProcessor($fileReader);
    }

    public function processOpenAPI(string $source): OpenAPIDto
    {
        return $this->openAPIProcessor->process($source);
    }
}