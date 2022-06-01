@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-dark text-white">Profile</div>

                <div class="card-body">

                    <div class="form-group"> First Name: {{ $user->fname }}.</div>
                    <div class="form-group"> Last Name: {{ $user->lname }}.</div>
                    <div class="form-group"> Email: {{ $user->email }}.</div>

                    <a href="{{route('profileUpdateView')}}" class="btn btn-primary">Update profile</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
