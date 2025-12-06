<?php

declare(strict_types=1);

namespace App\Kernel\Http\Service;

use App\Kernel\Http\Request;
use App\Kernel\Http\Route;
use Exception;

interface ControllerResolverInterface
{
    /**
     * @param Route $route
     * @param Request $request
     *
     * @throws Exception
     *
     * @return callable
     */
    public function getController(Route $route, Request $request): callable;
}
