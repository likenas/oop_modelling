<?php
declare(strict_types=1);

namespace App;


class Shelf
{
    /**
     * product area,  coke will be put in this area
     *
     * @var array
     */
    private $products = [];

    /**
     * shelf product capacity
     *
     * @var integer
     */
    private $totalCapacity = 20;

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Coke $coke
     * @return bool
     */
    public function addProduct(Coke $coke): bool
    {
        if (\count($this->getProducts()) < $this->getTotalCapacity()) {
            $this->products[] = $coke;

            return true;
        }

        return false;
    }

    public function getProductCount(): int
    {
        return \count($this->products);
    }

    /**
     * @param $count
     * @return int
     */
    public function removeProduct($count): int
    {
        $removedItem = 0;


        if ($count > $this->getProductCount()) {
            $count = $this->getProductCount();
        }

        if ($count <= $this->getProductCount()) {
            foreach ($this->products as $key => $product) {
                if ($removedItem < $count) {
                    unset($this->products[$key]);
                    ++$removedItem;
                }
            }
        }

        return $removedItem;
    }

    /**
     * @return int
     */
    public function getTotalCapacity(): int
    {
        return $this->totalCapacity;
    }

    /**
     * @param int $totalCapacity
     */
    public function setTotalCapacity(int $totalCapacity): void
    {
        $this->totalCapacity = $totalCapacity;
    }

}