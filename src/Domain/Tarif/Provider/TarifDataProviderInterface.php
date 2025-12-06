<?php

declare(strict_types=1);

namespace App\Domain\Tarif\Provider;

use App\Domain\Service\Entity\Service;
use App\Domain\Tarif\Entity\Tarif;
use App\Domain\User\Entity\User;
use Generator;

interface TarifDataProviderInterface
{
    /**
     * Fetch tarif by user and service
     */
    public function fetchByUserAndService(User $user, Service $service): ?Tarif;

    /**
     * Fetch tarif group by group id
     *
     * @return Generator|Tarif[]
     */
    public function fetchGroupByGroupId(int $groupId): Generator;

    /**
     * Fetch tarif by id
     */
    public function fetchById(int $id): ?Tarif;
}
