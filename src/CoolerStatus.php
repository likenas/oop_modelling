<?php
declare(strict_types=1);

namespace App;


class CoolerStatus
{
    /**
     * @var string
     */
    private $name;

    public function __construct($status)
    {
        $this->name = $status;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

}