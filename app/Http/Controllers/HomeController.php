<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ServiceOption;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customer = Customer::with([
                'customerPlan.servicePlan',
                'customerOptions.serviceOption'
            ])
            ->where('user_id', auth()->id())
            ->first();
        if (!$customer) {
            abort(401);
        }

        $customerOptionIds = [];
        foreach ($customer->customerOptions as $customerOption) {
            $customerOptionIds[] = $customerOption->serviceOption->id;
        }

        $customerOptions = [];
        $serviceOptions = ServiceOption::all();
        foreach ($serviceOptions as $serviceOption) {
            $customerOptions[] = [
                'name' => $serviceOption['name'] ?? '',
                'use' => in_array($serviceOption->id, $customerOptionIds, true),
            ];
        }

        return view('home', [
            'customer' => $customer,
            'customerOptions' => $customerOptions,
        ]);
    }
}
