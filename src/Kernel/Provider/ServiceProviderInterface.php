<?php

declare(strict_types=1);

namespace App\Kernel\Provider;

use App\Application;

interface ServiceProviderInterface
{
    /**
     * Register services in app container
     */
    public function register(Application $app): void;
}
