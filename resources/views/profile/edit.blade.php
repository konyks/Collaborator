@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Update Profile</h3>
        </div>
        <div class="col-md-4">
            <div align="right">
                <a href="{{route('profile.index', ['username' => Auth::user()->username])}}">
                    <button class="btn btn-default">
                        <i class="fa fa-eye"></i> View Profile
                    </button>
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div align="center">
        <img src="{{ asset('avatars/'.Auth::user()->getAvatarName()) }}" class="img-circle" alt="{{ Auth::user()->getNameOrUsername()}}" width="100" height="100" data-toggle="modal" data-target="#ProfilePicModal">
    </div>
    <div align="center">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ProfilePicModal">
            Change Picture
        </button>
    </div>
    <hr>
    <form class="form-vertical" role="form" method="post" action="{{route('profile.edit')}}">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="first_name" class="control-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name" value="{{Request::old('first_name') ?: Auth::user()->first_name }}">
                    @if($errors->has('first_name'))
                        <span class="help-block">{{$errors->first('first_name')}}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label for="last_name" class="control-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" value="{{Request::old('last_name') ?: Auth::user()->last_name}}">
                    @if($errors->has('last_name'))
                        <span class="help-block">{{$errors->first('last_name')}}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
            <label for="major" class="control-label">Major</label>
            <input type="text" name="major" class="form-control" id="major" value="{{Request::old('major') ?: Auth::user()->major}}">
            @if($errors->has('major'))
                <span class="help-block">{{$errors->first('major')}}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
            <label for="location" class="control-label">Location</label>
            <input type="text" name="location" class="form-control" id="location" value="{{Request::old('location') ?: Auth::user()->location}}">
            @if($errors->has('location'))
                <span class="help-block">{{$errors->first('location')}}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
            <label for="bio" class="control-label">Biography</label>
            <textarea name="bio" class="form-control" id="bio" rows="6">{{Request::old('bio') ?: Auth::user()->bio}}</textarea>
            @if($errors->has('bio'))
                <span class="help-block">{{$errors->first('bio')}}</span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
    <div class="modal fade" id="ProfilePicModal" tabindex="-1" role="dialog" aria-labelledby="ProfileModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Upload Profile Picture</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('avatar.edit')}}" method="post" enctype="multipart/form-data">
                        <p>Select image to upload:</p>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <input type="file" name="image" id="image">
                            @if($errors->has('image'))
                                <span class="help-block">{{$errors->first('image')}}</span>
                            @endif
                        </div>
                        <div class="modal-footer"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop