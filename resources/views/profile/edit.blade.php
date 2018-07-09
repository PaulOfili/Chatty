@extends ('templates.default')

@section('content')
<h3>Update your profile</h3>
<div class="row">
    <div class="col-lg-6">
        <form action="{{route('profile.edit')}}" method="post" role="form" class="form-vertical">
            <div class = "row">
                <div class="col-lg-6 form-group{{$errors->has('first_name') ? ' has-error' : ''}}">
                    <label for="first_name" class="control-label">First name</label>
                    <input type="text" name="first_name" id="first_name" value="{{Auth::user()->first_name ?: Request::old('first_name') }}" class="form-control">
                    @if ($errors->has('first_name'))
                        <span class="help-block">{{$errors->first('first_name')}}</span>
                    @endif
                </div>
                <div class="col-lg-6 form-group{{$errors->has('last_name') ? ' has-error' : ''}}">
                    <label for="last_name" class="control-label">Last name</label>
                    <input type="text" name="last_name" id="last_name" value="{{Auth::user()->last_name ?: Request::old('last_name') }}" class="form-control">
                    @if ($errors->has('last_name'))
                        <span class="help-block">{{$errors->first('last_name')}}</span>
                    @endif
                </div>
            </div>
            <div class="form-group{{$errors->has('location') ? ' has-error' : ''}}">
                <label for="location" class="control-label">Choose a location</label>
                <input type="text" name="location" id="location" class="form-control" value="{{Auth::user()->location ?: Request::old('location') }}">
                @if ($errors->has('location'))
                    <span class="help-block">{{$errors->first('location')}}</span>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-default" type="submit">Update</button>
            </div>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
</div>
@endsection
