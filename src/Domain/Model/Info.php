<?php

namespace Mibexx\PHPOpenApi\Domain\Model;

class Info
{
    public string $title;
    public string $version;
    public ?string $description;

    public function __construct(string $title, string $version, ?string $description = null)
    {
        $this->title = $title;
        $this->version = $version;
        $this->description = $description;
    }
}
