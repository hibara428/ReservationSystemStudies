@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>

        @if ($customerPlan)
        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Plan Information') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($servicePlans))
                                <tr>
                                    <td>Plan</td>
                                    <td>{{ $servicePlans[$customerPlan->getId()] ?? '-' }}</td>
                                </tr>
                            @endif
                            @if (!empty($contractedServiceOptionIds))
                            @foreach ($serviceOptions as $serviceOption)
                                <tr>
                                    <td>{{ $serviceOption->getName() }}</td>
                                    <td>{{ in_array($serviceOption->getId(), $contractedServiceOptionIds, true) ? '○' : '' }}</td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Customer Information') }}</div>

                    <div class="card-body">
                        @if ($customer)
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Id</td>
                                <td>{{ $customer->getId() }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ $customer->getName() }}</td>
                            </tr>
                            <tr>
                                <td>E-Mail</td>
                                <td>{{ $customer->getEmail() }}</td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td>{{ $customer->getAge() }}</td>
                            </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
