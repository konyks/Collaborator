@extends('templates.default')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Sign Up</h5>
            </div>
                <div class="panel-body">
                    <form class="form-vertical" role="form" method="post" action="{{ route('auth.signup')}}">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email Address</label>
                            <div class="input-group margin-bottom-sm" data-toggle="tooltip" data-placement="top" title="Enter your email">
                                <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                <input type="text" name="email" class="form-control" id="email" value="{{ Request::old('email') ?: ''}}">
                            </div>
                            @if($errors->has('email'))
                                <span class="help-block">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="control-label">Username</label>
                            <div class="input-group margin-bottom-sm" data-toggle="tooltip" data-placement="top" title="Enter your username">
                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                <input type="text" name="username" class="form-control" id="username" value="{{ Request::old('username') ?: ''}}">
                            </div>
                            @if($errors->has('username'))
                                <span class="help-block">{{$errors->first('username')}}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>
                            <div class="input-group margin-bottom-sm" data-toggle="tooltip" data-placement="top" title="Enter your password">
                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            @if($errors->has('password'))
                                <span class="help-block">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password_confirmation" class="control-label">Confirm Password</label>
                            <div class="input-group margin-bottom-sm" data-toggle="tooltip" data-placement="top" title="Confirm your password">
                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                            </div>
                            @if($errors->has('password_confirmation'))
                                <span class="help-block">{{$errors->first('password_confirmation')}}</span>
                            @endif
                        </div>
                        <div class="form-group" align="left">
                            <button type="submit" class="btn btn-primary">Sign up</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                </div>
	       </div>
     </div>
</div>
@stop