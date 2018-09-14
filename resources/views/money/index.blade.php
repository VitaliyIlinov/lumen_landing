@extends('money.layout')

@section('main')
    @env('BINOM_SERVER','fgh')
    {{--{{!!session()->all()}}--}}
    {{--{{request()->get('name')}}--}}
    @endenv('local')
    <div class="container">
        <div class="jumbotron">
            <div class="container">
                <h1>Money page</h1>
                <p>This is a template for a simple marketing or informational website. It includes a large callout called a
                   jumbotron and three supporting pieces of content. Use it as a starting point to create something more
                   unique.
                </p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
            </div>
        </div>
        <form method="post" action="/send">
            @include('helpers.input', ['field' => ['name'=>'transaction_id','type'=>'hidden']])
            @include('helpers.input', ['field' => ['name'=>'countryISO','type'=>'hidden']])
            <div class="row">
                <div class="form-group col-md-4">
                    @include('helpers.input', ['field' => ['name'=>'first_name','type'=>'text']])
                </div>
                <div class="form-group col-md-4">
                    @include('helpers.input', ['field' => ['name'=>'last_name','type'=>'text']])
                </div>
                <div class="form-group col-md-4">
                    @include('helpers.input', ['field' => ['name'=>'email_address','type'=>'text']])
                </div>
                <div class="form-group col-md-4">
                    @include('helpers.input', ['field' => ['name'=>'phone','type'=>'text']])
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection