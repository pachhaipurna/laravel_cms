@extends('layouts.master')
@section('title')
    404 Page Not Found
@stop
@section('content')
<div class="center-me positionabsolute">
    <div class="error-page">
        <h2 class="headline text-yellow mt25neg"> 404</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

            <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="{{route('assignment_dashboard')}}">return to dashboard</a>.
            </p>
        </div>
    </div>
</div>
@stop
