<!DOCTYPE html>
<html>
<body class="hold-transition login-page">
@section('title')
    403 No Permission
@stop
<div class="center-me positionabsolute">
    <div class="error-page">
        <h2 class="headline text-yellow mt25neg"> 403</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Sorry! You do not have permission.</h3>

            <p>
                You do not have permission for the content you are looking for.
                Meanwhile, you may <a href="{{route('assignment_dashboard')}}">return to dashboard</a>.
            </p>
        </div>
    </div>
</div>
</body>
</html>
