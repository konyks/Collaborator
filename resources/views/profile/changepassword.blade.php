@extends('templates.default')

@section('content')
    <h3>Change Password</h3>
    <hr>
    <form class="form-vertical" role="form" method="post" action="{{route('profile.changepassword')}}">
        <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
            <label for="oldpassword" class="control-label">Old Password</label>
            <div class="row">
                <div class="col-xs-4">
                    <input type="password" name="oldpassword" class="form-control" id="oldpassword">
                </div>
            </div>
            @if($errors->has('oldpassword'))
                <span class="help-block">{{$errors->first('oldpassword')}}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="control-label">New Password</label>
            <div class="row">
                <div class="col-xs-4">
                    <input type="password" name="password" class="form-control" id="password">
                </div>
            </div>
            @if($errors->has('password'))
                <span class="help-block">{{$errors->first('password')}}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password_confirmation" class="control-label">Confirm New Password</label>
            <div class="row">
                <div class="col-xs-4">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>
            </div>
        @if($errors->has('password_confirmation'))
                <span class="help-block">{{$errors->first('password_confirmation')}}</span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
@stop