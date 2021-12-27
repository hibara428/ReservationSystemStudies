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
                            <tr>
                                <td>Plan</td>
                                <td>{{ $customer->customerPlan->servicePlan->name }}</td>
                            </tr>
                            @foreach ($customerOptions as $customerOption)
                                <tr>
                                    <td>{{ $customerOption['name'] ?? '' }}</td>
                                    <td>{{ $customerOption['use'] ? '○' : '' }}</td>
                                </tr>
                            @endforeach
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
                                <td>{{ $customer->id }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ $customer->name }}</td>
                            </tr>
                            <tr>
                                <td>E-Mail</td>
                                <td>{{ $customer->email }}</td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td>{{ $customer->age }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
