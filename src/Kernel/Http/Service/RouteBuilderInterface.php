<?php

declare(strict_types=1);

namespace App\Kernel\Http\Service;

use App\Kernel\Http\Route;
use Exception;

interface RouteBuilderInterface
{
    /**
     * @throws Exception
     */
    public function buildRoute(array $routeParams): Route;
}
