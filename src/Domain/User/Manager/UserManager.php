<?php

declare(strict_types=1);

namespace App\Domain\User\Manager;

use App\Domain\User\Entity\User;
use App\Domain\User\Provider\UserDataProviderInterface;

class UserManager implements UserManagerInterface
{
    public function __construct(private readonly UserDataProviderInterface $userDataProvider) {}

    /**
     * @inheritDoc
     */
    public function getUserById(int $id): ?User
    {
        return $this->userDataProvider->fetchUserById($id);
    }
}
