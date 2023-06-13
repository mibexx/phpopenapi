<?php

namespace Mibexx\PHPOpenApi\Domain\Model;

class ExternalDocs
{
    public ?string $url;
    public ?string $description;

    public function __construct(?string $url = null, ?string $description = null)
    {
        $this->url = $url;
        $this->description = $description;
    }
}
