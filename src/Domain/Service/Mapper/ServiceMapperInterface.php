<?php

declare(strict_types=1);

namespace App\Domain\Service\Mapper;

use App\Domain\Service\Entity\Service;
use Exception;

interface ServiceMapperInterface
{
    /**
     * Converts raw data from database to service object
     *
     * @param array $rawData
     *
     * @throws Exception
     *
     * @return Service
     */
    public function mapToObject(array $rawData): Service;
}
