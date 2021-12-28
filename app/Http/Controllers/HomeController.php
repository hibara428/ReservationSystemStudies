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
            abort(400);
        }
        $customerOptionIds = $customer->customerOptions->pluck('id')->toArray();
        $serviceOptions = ServiceOption::select(['id', 'name'])->get();

        $customerOptions = [];
        foreach ($serviceOptions as $serviceOption) {
            $customerOptions[] = [
                'name' => $serviceOption->name,
                'use' => in_array($serviceOption->id, $customerOptionIds, true),
            ];
        }
        return view('home', [
            'customer' => $customer,
            'customerOptions' => $customerOptions,
        ]);
    }
}
