<?php

namespace App\Domain\Entity;

class CustomerOption
{
    /** @var int */
    protected $id;
    /** @var int */
    protected $customerId;
    /** @var int */
    protected $serviceOptionId;

    /**
     * @param int $id
     * @param int $customerId
     * @param int $serviceOptionId
     */
    public function __construct(int $id, int $customerId, int $serviceOptionId)
    {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->serviceOptionId = $serviceOptionId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @return int
     */
    public function getServiceOptionId(): int
    {
        return $this->serviceOptionId;
    }

}
