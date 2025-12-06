<?php

declare(strict_types=1);

namespace App\Kernel\Http;

use App\Kernel\Http\Service\ControllerResolverInterface;
use Exception;

class HttpKernel implements HttpKernelInterface
{
    public function __construct(private readonly RouterInterface $router, private readonly ControllerResolverInterface $resolver) {}

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            if (!$request->isJson()) {
                throw new Exception('Acceptable only JSON request', 400);
            }

            [$route, $params] = $this->router->process($request);
            $controller = $this->resolver->getController($route, $request);
            $response = call_user_func_array($controller, $params);
        } catch (Exception $e) {
            $response = $this->handleException($e, $request);
        }

        return $response;
    }

    private function handleException(Exception $e, Request $request): JsonResponse
    {
        return new JsonResponse(['error' => [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
        ]], $e->getCode());
    }
}
