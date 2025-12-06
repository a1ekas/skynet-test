<?php

declare(strict_types=1);

namespace App\Kernel\Http;

use Exception;

interface RouterInterface
{
    /**
     * Finds controller by request uri
     *
     * @throws Exception
     */
    public function process(Request $request): array;
}
