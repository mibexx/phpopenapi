<?php

namespace Mibexx\PHPOpenApi\Domain\Model;

class OpenAPIDto
{
    public string $openapi;
    public Info $info;
    public array $servers;
    public array $paths;
    public Components $components;
    public array $security;
    public array $tags;
    public ExternalDocs $externalDocs;

    public function __construct(
        string $openapi,
        Info $info,
        array $servers,
        array $paths,
        Components $components,
        array $security,
        array $tags,
        ExternalDocs $externalDocs
    ) {
        $this->openapi = $openapi;
        $this->info = $info;
        $this->servers = $servers;
        $this->paths = $paths;
        $this->components = $components;
        $this->security = $security;
        $this->tags = $tags;
        $this->externalDocs = $externalDocs;
    }
}
