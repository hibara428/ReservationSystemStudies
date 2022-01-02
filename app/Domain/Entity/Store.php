<?php

namespace App\Domain\Entity;

class Store
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $name;
    /** @var string */
    protected $description;
    /** @var int */
    protected $numOfCompartment;

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param int $numOfCompartment
     */
    public function __construct(int $id, string $name, string $description, int $numOfCompartment)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->numOfCompartment = $numOfCompartment;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getNumOfCompartment(): int
    {
        return $this->numOfCompartment;
    }
}
