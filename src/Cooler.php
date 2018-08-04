<?php
declare(strict_types=1);

namespace App;


class Cooler
{
    /**
     * @var CoolerStatus
     */
    private $status;

    /**
     * @var array
     */
    private $shelves = [];

    public function __construct(int $shelfCount = 1, int $shelfCapacity)
    {
        $this->status = new CoolerStatus('Empty');
        for ($i = 1; $i <= $shelfCount; $i++) {
            $shelf = new Shelf();
            $this->addShelf($shelf);
        }
    }

    /**
     * @return CoolerStatus
     */
    public function getStatus(): CoolerStatus
    {
        return $this->status;
    }

    /**
     * @param CoolerStatus $status
     */
    public function setStatus(CoolerStatus $status): void
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getShelves(): array
    {
        return $this->shelves;
    }

    /**
     * @return int
     */
    public function getShelvesCount(): int
    {
        return count($this->shelves);
    }

    /**
     * @param Shelf $shelf
     */
    public function addShelf(Shelf $shelf): void
    {
        $this->shelves[] = $shelf;
    }

}