<?php

namespace App\Domain\Entity;

class CustomerPlan
{
    /** @var int */
    protected $id;
    /** @var int */
    protected $customerId;
    /** @var int */
    protected $servicePlanId;

    /**
     * @param int $id
     * @param int $customerId
     * @param int $servicePlanId
     */
    public function __construct(int $id, int $customerId, int $servicePlanId)
    {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->servicePlanId = $servicePlanId;
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
    public function getServicePlanId(): int
    {
        return $this->servicePlanId;
    }
}
