<?php

namespace App\Providers;

use App\DataProvider\CustomerContractRepositoryInterface;
use App\DataProvider\ServiceOptionRepositoryInterface;
use App\DataProvider\StoreRepositoryInterface;
use App\Domain\Repository\CustomerContractRepository;
use App\Domain\Repository\ServiceOptionRepository;
use App\Domain\Repository\StoreRepository;
use App\Services\CustomerService;
use App\Services\StoreService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
        $this->app->bind(ServiceOptionRepositoryInterface::class, ServiceOptionRepository::class);
        $this->app->bind(CustomerContractRepositoryInterface::class, CustomerContractRepository::class);

        $this->app->bind(StoreService::class);
        $this->app->bind(CustomerService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
