@extends ('templates.default')

@section('content')
<h3>Sign In</h3>
<div class="row">
        <div class="col-lg-6">
            <form action="{{route('auth.signin')}}" method="post" role="form" class="form-vertical">
                <div class="form-group{{$errors->has('email') ? ' has-error' : ''}}">
                    <label for="email" class="control-label">Your email address</label>
                    <input type="text" name="email" id="email" value="{{Request::old('email') ?: ''}}" class="form-control" required autofocus> 
                    @if ($errors->has('email'))
                        <span class="help-block">{{        $errors->first('email')}}</span>
                    @endif           
                </div>              
                <div class="form-group{{$errors->has('password') ? ' has-error' : ''}}">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @if ($errors->has('password'))
                        <span class="help-block">{{$errors->first('password')}}</span>
                    @endif
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember">Remember me
                    </label>
                </div>
                <div class="form-group">
                    <button class="btn btn-default" type="submit">Sign In</button>
                </div>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>
    </div>
@endsection