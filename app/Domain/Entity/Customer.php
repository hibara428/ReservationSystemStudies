<?php

namespace App\Domain\Entity;

class Customer
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $name;
    /** @var string */
    protected $email;
    /** @var int */
    protected $age;
    /** @var int */
    protected $userId;

    /**
     * @param int $id
     * @param string $name
     * @param string $email
     * @param int $age
     * @param int $userId
     */
    public function __construct(int $id, string $name, string $email, int $age, int $userId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->userId = $userId;
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
