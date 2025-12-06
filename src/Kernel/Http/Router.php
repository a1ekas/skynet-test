<?php

declare(strict_types=1);

namespace App\Kernel\Http;

use App\Kernel\Http\Service\UrlMatcherInterface;

class Router implements RouterInterface
{
    public function __construct(private readonly UrlMatcherInterface $urlMatcher) {}

    /**
     * @inheritDoc
     */
    public function process(Request $request): array
    {
        /** @var Route $route */
        [$route, $params] = $this->urlMatcher->match($request);
        array_unshift($params, $request);

        return [$route, $params];
    }
}
