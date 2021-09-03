<!DOCTYPE html>
<html>
<body class="hold-transition login-page">
@section('title')
    500 No Permission
@stop
<div class="center-me positionabsolute">
    <div class="error-page">
        <h2 class="headline text-yellow mt25neg"> 500</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Internal Server Error.</h3>

            <p>
                Something went wrong. Please contact the support.
                Meanwhile, you may <a href="{{route('assignment_dashboard')}}">return to dashboard</a>.
            </p>
        </div>
    </div>
</div>
</body>
</html>
