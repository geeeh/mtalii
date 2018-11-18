@extends('layouts.app')

@section('content')
    <div class="login">
        <div class="outer">
            <div class="middle">
                <div class="inner">
                    <h4> SIGN IN </h4>
                    <p> Login and access mtalii services. This will help us know assist you better <p>
                        <a class="btn btn-lg btn-warning custom-bt" href="{{ url('/redirect') }}"><img src="/imgs/google-plus.svg"> google login</a>
                </div>
            </div>
        </div>
    </div>

@endsection
