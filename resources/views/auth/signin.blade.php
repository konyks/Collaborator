@extends('templates.default')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                      <h5>Sign In</h5>
                </div>
                    <div class="panel-body">
                        <form class="form-vertical" role="form" method="post" action="{{ route('auth.signin')}}">
                            <div style="margin-bottom: 25px" class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">Username</label>
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
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember me
                                </label>
                            </div>
                            <div class="form-group" align="left">
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </form>
                        <hr>
                        <div align="center">
                            <a href="{{route('google.auth')}}" align="center">
                                <button class="btn btn-lg btn-default">
                                    <img src="{{ asset('img/new-google-favicon-logo.png')}}" alt="Google Logo" width="30" height="30">
                                     Sign in with <b>Google</b> 
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop