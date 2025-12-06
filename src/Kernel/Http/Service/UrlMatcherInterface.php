<?php

declare(strict_types=1);

namespace App\Kernel\Http\Service;

use App\Kernel\Http\Request;
use App\Kernel\Http\Route;
use Exception;

interface UrlMatcherInterface
{
    /**
     * Match path info with routes and return route handler params
     *
     * @throws Exception
     */
    public function match(Request $request): array;

    /**
     * Adds route to route collection
     */
    public function addRoute(Route $route): void;
}
