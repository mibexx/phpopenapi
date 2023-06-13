<?php

namespace Mibexx\PHPOpenApi\Domain\Model;

class Components
{
    public array $schemas;

    public function __construct()
    {
        $this->schemas = [];
    }
}
