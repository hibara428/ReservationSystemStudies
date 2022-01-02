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
    /** @var ServicePlan|null */
    protected $servicePlan;

    /**
     * @param int $id
     * @param int $customerId
     * @param int $servicePlanId
     * @param ServicePlan|null $servicePlan
     */
    public function __construct(int $id, int $customerId, int $servicePlanId, ServicePlan $servicePlan = null)
    {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->servicePlanId = $servicePlanId;
        $this->servicePlan = $servicePlan;
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

    /**
     * @return ServicePlan|null
     */
    public function getServicePlan(): ?ServicePlan
    {
        return $this->servicePlan;
    }

    /**
     * @return string|null
     */
    public function getServicePlanName(): ?string
    {
        return $this->servicePlan ? $this->servicePlan->getName() : null;
    }

}
