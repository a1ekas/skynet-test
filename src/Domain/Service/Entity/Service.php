<?php

declare(strict_types=1);

namespace App\Domain\Service\Entity;

use DateTimeInterface;

class Service
{
    private int $id = 0;

    private int $userId = 0;

    private int $tarifId = 0;

    private DateTimeInterface $payDay;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getTarifId(): int
    {
        return $this->tarifId;
    }

    public function setTarifId(int $tarifId): void
    {
        $this->tarifId = $tarifId;
    }

    public function getPayDay(): DateTimeInterface
    {
        return $this->payDay;
    }

    public function setPayDay(DateTimeInterface $payDay): void
    {
        $this->payDay = $payDay;
    }
}
