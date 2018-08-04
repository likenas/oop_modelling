<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;


final class CoolerTest extends TestCase
{

    public function test_should_be_three_shelves()
    {
        $cooler = new \App\Cooler(3, 20);

        $this->assertEquals($cooler->getShelvesCount(), 3);
    }

    public function test_should_be_sixteen_empty_area_inside_three_shelves()
    {
        $cooler = new \App\Cooler(3, 20);

        $totalEmptyArea = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalEmptyArea += $shelf->getTotalCapacity() - count($shelf->getProducts());
        }

        $this->assertEquals($totalEmptyArea, 60);
    }

    public function test_should_has_product_in_the_cooler()
    {
        $cooler = new \App\Cooler(3, 20);

        $totalItem = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
        }

        $this->assertEquals($totalItem, 0);
    }

    public function test_should_one_product_has_in_the_cooler()
    {
        $cooler = new \App\Cooler(3, 20);

        $totalItem = 0;
        $totalCapacity = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
            $totalCapacity += $shelf->getTotalCapacity() - $shelf->getProductCount();
        }

        if (0 === $totalItem) {
            /** @var \App\Shelf $shelf */
            foreach ($cooler->getShelves() as $shelf) {
                for ($i = 1; $i <= ($shelf->getTotalCapacity() - $shelf->getProductCount()); $i++) {
                    if ($totalItem < 1) {
                        $coke = new \App\Coke('Coca Cola 33ml');
                        $shelf->addProduct($coke);
                        ++$totalItem;
                    }
                }
            }

            $cooler->setStatus(new \App\CoolerStatus('Partly Full'));
        }

        $this->assertEquals($totalItem, 1);
    }

    public function test_should_one_more_product_has_in_the_cooler()
    {
        $cooler = new \App\Cooler(3, 20);

        $totalItem = 0;
        $totalCapacity = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
            $totalCapacity += $shelf->getTotalCapacity() - $shelf->getProductCount();
        }

        if (0 === $totalItem) {
            /** @var \App\Shelf $shelf */
            foreach ($cooler->getShelves() as $shelf) {
                $shelfAreaCapacity = $shelf->getTotalCapacity() - $shelf->getProductCount();
                for ($i = 1; $i <= $shelfAreaCapacity; $i++) {
                    if ($totalItem < 23 && $totalItem <= $totalCapacity) {
                        $coke = new \App\Coke('Coca Cola 33ml');
                        $shelf->addProduct($coke);
                        ++$totalItem;
                    }
                }
            }

            $cooler->setStatus(new \App\CoolerStatus('Partly Full'));
        }

        $this->assertEquals($totalItem, 23);
    }

    public function test_cooler_should_be_empty(): void
    {
        $cooler = new \App\Cooler(3, 20);

        $totalItem = 0;
        $totalCapacity = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
            $totalCapacity += $shelf->getTotalCapacity();
        }

        $hasCapacity = $totalCapacity - $totalItem;

        if (60 === $hasCapacity) {
            $cooler->setStatus(new \App\CoolerStatus('Empty'));
        }

        $this->assertEquals($cooler->getStatus()->getName(), 'Empty');
    }

    public function test_cooler_should_be_partly_full()
    {
        $cooler = new \App\Cooler(3, 20);

        $totalItem = 0;
        $totalCapacity = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
            $totalCapacity += $shelf->getTotalCapacity();
        }

        if (0 === $totalItem) {
            /** @var \App\Shelf $shelf */
            foreach ($cooler->getShelves() as $shelf) {
                $shelfAreaCapacity = $shelf->getTotalCapacity() - $shelf->getProductCount();
                for ($i = 1; $i <= $shelfAreaCapacity; $i++) {
                    if ($totalItem < 23 && $totalItem < $totalCapacity) {
                        $coke = new \App\Coke('Coca Cola 33ml');
                        $shelf->addProduct($coke);
                        ++$totalItem;
                    }
                }
            }
        }

        $totalItem = 0;
        $totalCapacity = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
            $totalCapacity += $shelf->getTotalCapacity();
        }

        $hasCapacity = $totalCapacity - $totalItem;

        if ($hasCapacity > 0 && $hasCapacity < $totalCapacity) {
            $cooler->setStatus(new \App\CoolerStatus('Partly Full'));
        }

        $this->assertEquals($cooler->getStatus()->getName(), 'Partly Full');
    }

    public function test_cooler_should_be_full()
    {
        $cooler = new \App\Cooler(3, 20);

        $totalItem = 0;
        $totalCapacity = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
            $totalCapacity += $shelf->getTotalCapacity();
        }

        $hasCapacity = $totalCapacity - $totalItem;

        if (0 === $totalItem && $hasCapacity > 0) {
            /** @var \App\Shelf $shelf */
            foreach ($cooler->getShelves() as $shelf) {
                $shelfAreaCapacity = $shelf->getTotalCapacity() - $shelf->getProductCount();
                for ($i = 1; $i <= $shelfAreaCapacity; $i++) {
                    if ($totalItem < $totalCapacity) {
                        $coke = new \App\Coke('Coca Cola 33ml');
                        $shelf->addProduct($coke);
                        ++$totalItem;
                    }
                }
            }

            $cooler->setStatus(new \App\CoolerStatus('Partly Full'));
        }

        $totalItem = 0;
        $totalCapacity = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
            $totalCapacity += $shelf->getTotalCapacity();
        }

        $hasCapacity = $totalCapacity - $totalItem;

        if (0 === $hasCapacity) {
            $cooler->setStatus(new \App\CoolerStatus('Full'));
        }

        $this->assertEquals($cooler->getStatus()->getName(), 'Full');
    }

    public function test_should_be_one_item_missing_in_the_full_cooler()
    {
        $cooler = new \App\Cooler(3, 20);

        $totalItem = 0;
        $totalCapacity = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
            $totalCapacity += $shelf->getTotalCapacity();
        }

        //fill it
        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $shelfAreaCapacity = $shelf->getTotalCapacity() - $shelf->getProductCount();
            for ($i = 1; $i <= $shelfAreaCapacity; $i++) {
                if ($totalItem < $totalCapacity) {
                    $coke = new \App\Coke('Coca Cola 33ml');
                    $shelf->addProduct($coke);
                    ++$totalItem;
                }
            }
        }

        $cooler->setStatus(new \App\CoolerStatus('Full'));

        //pick one coke in the shelf's product area
        $totalPicketItemCount = 1;
        $pickedItem = 0;
        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            if ($shelf->getProductCount() > 0) {
                if ($pickedItem <= $totalPicketItemCount) {
                    $pickedItem += $shelf->removeProduct($totalPicketItemCount - $pickedItem);
                }
            }
        }

        $totalItem = 0;
        $totalCapacity = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
            $totalCapacity += $shelf->getTotalCapacity();
        }

        $hasCapacity = $totalCapacity - $totalItem;

        if (1 === $hasCapacity) {
            $cooler->setStatus(new \App\CoolerStatus('Partly Full'));
        }

        $this->assertEquals($hasCapacity, $totalPicketItemCount);
    }

    public function test_should_be_one_more_item_missing_in_the_full_cooler()
    {
        $cooler = new \App\Cooler(3, 20);

        $totalItem = 0;
        $totalCapacity = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
            $totalCapacity += $shelf->getTotalCapacity();
        }

        //fill it
        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $shelfAreaCapacity = $shelf->getTotalCapacity() - $shelf->getProductCount();
            for ($i = 1; $i <= $shelfAreaCapacity; $i++) {
                if ($totalItem < $totalCapacity) {
                    $coke = new \App\Coke('Coca Cola 33ml');
                    $shelf->addProduct($coke);
                    ++$totalItem;
                }
            }
        }

        $cooler->setStatus(new \App\CoolerStatus('Full'));

        //pick one more coke in the shelf's product area
        $totalPicketItemCount = 21;
        $pickedItem = 0;
        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            if ($shelf->getProductCount() > 0) {
                if ($pickedItem <= $totalPicketItemCount) {
                    $pickedItem += $shelf->removeProduct($totalPicketItemCount - $pickedItem);
                }
            }
        }

        $totalItem = 0;
        $totalCapacity = 0;

        /** @var \App\Shelf $shelf */
        foreach ($cooler->getShelves() as $shelf) {
            $totalItem += $shelf->getProductCount();
            $totalCapacity += $shelf->getTotalCapacity();
        }

        $hasCapacity = $totalCapacity - $totalItem;

        if ($hasCapacity > 0) {
            $cooler->setStatus(new \App\CoolerStatus('Partly Full'));
        }

        if (60 === $hasCapacity) {
            $cooler->setStatus(new \App\CoolerStatus('Empty'));
        }

        $this->assertEquals($hasCapacity, $totalPicketItemCount);
    }

}