<?php

declare(strict_types=1);

namespace App\Domain\Tarif\Controller\Action;

use App\Domain\Service\Manager\ServiceManagerInterface;
use App\Domain\Tarif\Manager\TarifManagerInterface;
use App\Domain\User\Manager\UserManagerInterface;
use App\Kernel\Http\JsonResponse;
use App\Kernel\Http\Request;
use Exception;

class GetUsersServicesTarifsAction
{
    public function __construct(private readonly UserManagerInterface $userManager, private readonly ServiceManagerInterface $serviceManager, private readonly TarifManagerInterface $tarifManager) {}

    public function __invoke(
        Request $request,
        int $userId,
        int $serviceId
    ): JsonResponse {
        try {
            if (!$user = $this->userManager->getUserById($userId)) {
                throw new Exception('User not found', 404);
            }

            if (!$service = $this->serviceManager->getServiceByUserAndId($user, $userId)) {
                throw new Exception('User service not found', 404);
            }

            if (!$tarif = $this->tarifManager->getTarifByUserAndService($user, $service)) {
                throw new Exception('Tariff not found', 404);
            }

            return new JsonResponse(
                [
                    'result' => 'ok',
                    'tarifs' => $tarif->toArray(true),
                ]
            );
        } catch (Exception $e) {
            return new JsonResponse(
                [
                    'result' => 'error',
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => $e->getCode(),
                    ],
                ],
                $e->getCode()
            );
        }
    }
}
