<?php

declare(strict_types=1);

namespace App\Domain\Tarif\Entity;

class TarifGroup
{
    /** @var Tarif[] */
    private array $tarifs;

    public function __construct(private int $id)
    {
        $this->tarifs = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Tarif[]
     */
    public function getTarifs(): array
    {
        return $this->tarifs;
    }

    /**
     * @param Tarif[] $tarifs
     */
    public function setTarifs(array $tarifs): void
    {
        $this->tarifs = $tarifs;
    }

    public function addTarif(Tarif $tarif): void
    {
        $this->tarifs[] = $tarif;
    }

    public function toArray()
    {
        $data = [];

        foreach ($this->tarifs as $tarif) {
            $data[] = $tarif->toArray();
        }

        return $data;
    }
}
