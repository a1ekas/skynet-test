<?php

declare(strict_types=1);

namespace App\Domain\Tarif\Manager;

use App\Domain\Service\Entity\Service;
use App\Domain\Tarif\Entity\Tarif;
use App\Domain\Tarif\Provider\TarifDataProviderInterface;
use App\Domain\User\Entity\User;

class TarifManager implements TarifManagerInterface
{
    public function __construct(private readonly TarifDataProviderInterface $tarifDataProvider) {}

    /**
     * @inheritDoc
     */
    public function getTarifByUserAndService(
        User $user,
        Service $service
    ): ?Tarif {
        return $this->tarifDataProvider->fetchByUserAndService($user, $service);
    }

    /**
     * @inheritDoc
     */
    public function getTarifById(int $id): ?Tarif
    {
        return $this->tarifDataProvider->fetchById($id);
    }
}
