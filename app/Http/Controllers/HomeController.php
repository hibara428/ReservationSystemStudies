<?php

namespace App\Http\Controllers;

use App\Domain\Entity\ServicePlan;
use App\Services\CustomerService;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /** @var CustomerService */
    protected $customerService;

    /**
     * Constructor.
     *
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function __invoke()
    {
        $userId = auth()->id();
        $customerContract = $this->customerService->findCustomerContractByUserId($userId);
        if (!$customerContract) {
            abort(400);
        }

        return view('home', [
            'customer' => $customerContract->getCustomer(),
            'customerPlan' => $customerContract->getCustomerPlan(),
            'servicePlans' => collect($this->customerService->getServicePlans())
                ->mapWithKeys(function (ServicePlan $servicePlan): array {
                    return [
                        $servicePlan->getId() => $servicePlan->getName(),
                    ];
                })->toArray(),
            'serviceOptions' => $this->customerService->getServiceOptions(),
            'contractedServiceOptionIds' => $customerContract->getServiceOptionIds(),
        ]);
    }
}
