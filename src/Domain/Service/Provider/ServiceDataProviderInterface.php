<?php

declare(strict_types=1);

namespace App\Domain\Service\Provider;

use App\Domain\Service\Entity\Service;
use App\Domain\User\Entity\User;

interface ServiceDataProviderInterface
{
    /**
     * Fetches service data from database
     */
    public function fetchServiceByUserAndId(User $user, int $id): ?Service;

    /**
     * Save service to database
     */
    public function save(Service $service): void;
}
