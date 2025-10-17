@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login (Simple View)</div>

                <div class="card-body">
                    <p>This is a placeholder login page.</p>
                    <h1>Hello World</h1>
                    <p>Dont have an account? <a href="{{ route('register') }}">Register here</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
