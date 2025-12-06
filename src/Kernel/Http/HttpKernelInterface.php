<?php

declare(strict_types=1);

namespace App\Kernel\Http;

interface HttpKernelInterface
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request);
}
