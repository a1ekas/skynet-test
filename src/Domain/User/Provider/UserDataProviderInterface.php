<?php

declare(strict_types=1);

namespace App\Domain\User\Provider;

use App\Domain\User\Entity\User;

interface UserDataProviderInterface
{
    /**
     * Fetches user object from database
     */
    public function fetchUserById(int $id): ?User;
}
