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
     * @throws Exception
     */
    public function mapToObject(array $rawData): User;
}
