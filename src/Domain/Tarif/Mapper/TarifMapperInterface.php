<?php

declare(strict_types=1);

namespace App\Domain\Tarif\Mapper;

use App\Domain\Tarif\Entity\Tarif;
use Exception;

interface TarifMapperInterface
{
    /**
     * Converts database raw data to object
     *
     * @throws Exception
     */
    public function mapToObject(array $rawData): Tarif;
}
