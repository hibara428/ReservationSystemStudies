@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Store List</div>

                <div class="card-body">
                    <ul>
                        @foreach ($links as $link)
                            <li><a href="{{ $link['href'] ?? '' }}">{{ $link['name'] ?? '' }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
