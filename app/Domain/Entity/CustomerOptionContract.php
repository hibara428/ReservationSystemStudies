<?php

namespace App\Domain\Entity;

class CustomerOptionContract
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $name;
    /** @var bool */
    protected $isContracted;

    /**
     * @param int $id
     * @param string $name
     * @param bool $isContracted
     */
    public function __construct(int $id, string $name, bool $isContracted)
    {
        $this->id = $id;
        $this->name = $name;
        $this->isContracted = $isContracted;
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
     * @return bool
     */
    public function isContracted(): bool
    {
        return $this->isContracted;
    }

}
