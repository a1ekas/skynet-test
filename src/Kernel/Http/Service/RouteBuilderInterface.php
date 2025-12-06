<?php

declare(strict_types=1);

namespace App\Kernel\Http\Service;

use App\Kernel\Http\Route;
use Exception;

interface RouteBuilderInterface
{
    /**
     * @param array $routeParams
     *
     * @throws Exception
     *
     * @return Route
     */
    public function buildRoute(array $routeParams): Route;
}
