<?php

namespace Mibexx\PHPOpenApi\Infrastructure\Persistence;

class OpenAPIFileReader
{
    public function readSpecification(string $source): string
    {
        return file_get_contents($source);
    }
}
