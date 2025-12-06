<?php

declare(strict_types=1);

namespace App\Domain\Tarif\Manager;

use App\Domain\Service\Entity\Service;
use App\Domain\Tarif\Entity\Tarif;
use App\Domain\User\Entity\User;

interface TarifManagerInterface
{
    /**
     * Returns tarif object by user and service
     */
    public function getTarifByUserAndService(User $user, Service $service): ?Tarif;

    /**
     * Returns tarif object by id
     */
    public function getTarifById(int $id): ?Tarif;
}
