@extends('money.layout')
@section('main')
    <div class="container">
        <div class="jumbotron" style="position: absolute;top: 50%; transform: translateY(-50%)">
                <h1>{{ $errors->first()}}</h1>
            <p class="lead">The page you are looking for was not found.</p>
            <p><a href="/" class="btn btn-lg btn-success">Back to Home</a></p>
        </div>
    </div>
@endsection