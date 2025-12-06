<?php

declare(strict_types=1);

namespace App\Kernel\Http;

class Route
{
    /** @var callable|object|string */
    private $controller;

    public function __construct(
        private readonly string $pattern,
        private readonly string $method,
        $controller,
        private readonly array $requirements = []
    ) {
        $this->controller = $controller;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return callable|object|string
     */
    public function getController()
    {
        return $this->controller;
    }

    public function getRequirements(): array
    {
        return $this->requirements;
    }
}
