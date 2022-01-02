@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $store->getName() }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $store->getDescription() }}
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $store->getName() }}</td>
                            </tr>
                            <tr>
                                <td>Number of Compartment</td>
                                <td>{{ $store->getNumOfCompartment() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
