<?php

declare(strict_types=1);

namespace App\Domain\Tarif\Entity;

use DateInterval;
use DateTime;

class Tarif
{
    private int $id = 0;

    private string $link;

    private int $payPeriod = 0;

    private int $tarifGroupId = 0;

    private TarifGroup $tarifGroup;

    public function __construct(private string $title, private float $price, private int $speed) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): void
    {
        $this->speed = $speed;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getPayPeriod(): int
    {
        return $this->payPeriod;
    }

    public function setPayPeriod(int $payPeriod): void
    {
        $this->payPeriod = $payPeriod;
    }

    public function getTarifGroupId(): int
    {
        return $this->tarifGroupId;
    }

    public function setTarifGroupId(int $tarifGroupId): void
    {
        $this->tarifGroupId = $tarifGroupId;
    }

    public function getTarifGroup(): TarifGroup
    {
        return $this->tarifGroup;
    }

    public function setTarifGroup(TarifGroup $tarifGroup): void
    {
        $this->tarifGroup = $tarifGroup;
    }

    public function toArray($withTarifGroup = false)
    {
        if ($withTarifGroup) {
            return [
                'title' => $this->title,
                'link' => $this->link,
                'speed' => $this->speed,
                'tarifs' => $this->tarifGroup->toArray(),
            ];
        }
        $newPayDay = new DateTime();
        $newPayDay->setTime(0, 0, 0);
        $newPayDay->add(new DateInterval('P' . $this->payPeriod . 'M'));
        $tzOffsetString = $newPayDay->format('P');
        $tzPrefix = str_replace(':', '', $tzOffsetString);

        return [
            'ID' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'pay_period' => $this->payPeriod,
            'new_payday' => $newPayDay->getTimestamp() . $tzPrefix,
            'speed' => $this->speed,
        ];
    }
}
