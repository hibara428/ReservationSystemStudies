<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $userId = auth()->id();
        $customerContract = $this->customerService->findCustomerContractByUserId($userId);
        if (!$customerContract) {
            abort(400);
        }
        $serviceOptions = $this->customerService->retrieveServiceOptions();
        if (!$serviceOptions) {
            abort(400);
        }
        return view('home', [
            'customer' => $customerContract->getCustomer(),
            'customerPlan' => $customerContract->getCustomerPlan(),
            'customerOptionContracts' => $customerContract->getCustomerOptionContracts($serviceOptions),
        ]);
    }
}
