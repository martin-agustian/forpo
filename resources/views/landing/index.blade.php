@extends('layouts.landing_master')

@section('content')

<section class="container vh-100 flex-xy-center">
    <div class="row">
        <div class="col-12 text-center mb-2">
            <h1 class="text-lg text-bold">THIS IS LANDING</h1>
        </div>
        <div class="col-12 text-center mb-0">
            <a href="{{ route('auth.login') }}" class="btn btn-outline-grey mx-1">
                Login
            </a>
            <a href="{{ route('auth.register') }}" class="btn btn-one mx-1">
                Register
            </a>
        </div>
    </div>
</section>

@endsection