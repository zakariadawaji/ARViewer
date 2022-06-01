@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-dark text-white">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    Welcome {{ Auth::user()->fname . ' ' . Auth::user()->lname }}!! <br/><br/>
                    You have {{ count( Auth::user()->items ) }} Item(s). <br/> <br/>
                    <a href="{{ route('items') }}" class="btn btn-sm btn-primary">Manage Items</a> or <a href="{{ route('profile') }}" class="btn btn-sm btn-primary">Manage Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@csrf
@endsection
