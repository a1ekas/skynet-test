<?php

declare(strict_types=1);

namespace App\Kernel\Http;

use Exception;

interface RouterInterface
{
    /**
     * Finds controller by request uri
     *
     * @param Request $request
     *
     * @throws Exception
     *
     * @return array
     */
    public function process(Request $request): array;
}
