<?php

declare(strict_types=1);

namespace App\Domain\User\Mapper;

use App\Domain\User\Entity\User;
use Exception;

interface UserMapperInterface
{
    /**
     * Converts raw data from database to user object
     *
     * @param array $rawData
     *
     * @throws Exception
     *
     * @return User
     */
    public function mapToObject(array $rawData): User;
}
