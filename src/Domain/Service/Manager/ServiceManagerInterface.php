<?php

declare(strict_types=1);

namespace App\Domain\Service\Manager;

use App\Domain\Service\Entity\Service;
use App\Domain\Tarif\Entity\Tarif;
use App\Domain\User\Entity\User;

interface ServiceManagerInterface
{
    /**
     * Returns service by user and id
     */
    public function getServiceByUserAndId(User $user, int $id): ?Service;

    /**
     * Set tarif to service
     */
    public function setTarif(Service $service, Tarif $tarif): void;
}
