<?php

declare(strict_types=1);

namespace App\Domain\User\Manager;

use App\Domain\User\Entity\User;

interface UserManagerInterface
{
    /**
     * Returns user by id
     */
    public function getUserById(int $id): ?User;
}
